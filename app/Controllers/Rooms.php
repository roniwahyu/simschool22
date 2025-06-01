<?php

namespace App\Controllers;

use App\Models\RoomModel;

class Rooms extends BaseController
{
    protected $roomModel;

    public function __construct()
    {
        $this->roomModel = new RoomModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Room Management',
            'breadcrumb' => ['Dashboard' => '/', 'Rooms'],
        ];

        return $this->render('rooms/index', $data);
    }

    public function datatables()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/rooms');
        }

        $request = $this->request;
        $draw = intval($request->getVar('draw'));
        $start = intval($request->getVar('start'));
        $length = intval($request->getVar('length'));
        $searchValue = $request->getVar('search')['value'] ?? '';

        $builder = $this->roomModel->getBuilder();

        // Total records
        $totalRecords = $builder->countAllResults(false);

        // Search
        if (!empty($searchValue)) {
            $builder->groupStart();
            $builder->like('room_no', $searchValue);
            $builder->orLike('room_type', $searchValue);
            $builder->orLike('description', $searchValue);
            $builder->groupEnd();
        }

        $filteredRecords = $builder->countAllResults(false);

        // Order
        $orderColumnIndex = intval($request->getVar('order')[0]['column'] ?? 0);
        $orderDirection = $request->getVar('order')[0]['dir'] ?? 'asc';
        
        $columns = ['id', 'room_no', 'room_type', 'capacity', 'is_active', 'created_at'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        
        $builder->orderBy($orderColumn, $orderDirection);

        // Limit
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $rooms = $builder->get()->getResultArray();

        $data = [];
        foreach ($rooms as $room) {
            $statusBadge = $room['is_active'] === 'yes' 
                ? '<span class="badge bg-success">Active</span>' 
                : '<span class="badge bg-danger">Inactive</span>';

            $typeBadge = '';
            switch ($room['room_type']) {
                case 'classroom':
                    $typeBadge = '<span class="badge bg-primary">Classroom</span>';
                    break;
                case 'laboratory':
                    $typeBadge = '<span class="badge bg-info">Laboratory</span>';
                    break;
                case 'library':
                    $typeBadge = '<span class="badge bg-warning">Library</span>';
                    break;
                case 'auditorium':
                    $typeBadge = '<span class="badge bg-dark">Auditorium</span>';
                    break;
                default:
                    $typeBadge = '<span class="badge bg-secondary">Other</span>';
            }

            $actions = '
                <div class="btn-group btn-group-sm">
                    <a href="' . base_url('rooms/edit/' . $room['id']) . '" class="btn btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-outline-info" onclick="viewSchedule(' . $room['id'] . ')" title="View Schedule">
                        <i class="fas fa-calendar"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteRoom(' . $room['id'] . ')" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';

            $data[] = [
                $room['room_no'],
                $typeBadge,
                $room['capacity'] ?? 'N/A',
                $room['description'] ?? '',
                $statusBadge,
                date('d/m/Y', strtotime($room['created_at'])),
                $actions
            ];
        }

        $response = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Add New Room',
            'breadcrumb' => ['Dashboard' => '/', 'Rooms' => '/rooms', 'Add New'],
        ];

        return $this->render('rooms/create', $data);
    }

    public function store()
    {
        $rules = [
            'room_no' => 'required|min_length[1]|max_length[50]|is_unique[room_list.room_no]',
            'room_type' => 'required|in_list[classroom,laboratory,library,auditorium,other]',
            'capacity' => 'permit_empty|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'room_no' => $this->request->getPost('room_no'),
                'room_type' => $this->request->getPost('room_type'),
                'capacity' => $this->request->getPost('capacity'),
                'description' => $this->request->getPost('description'),
                'is_active' => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $roomId = $this->roomModel->insert($data);

            if ($roomId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $roomId], 'Room added successfully!');
                }
                $this->setSuccess('Room added successfully!');
                return redirect()->to('/rooms');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to add room');
                }
                $this->setError('Failed to add room');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Room creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while adding the room');
            }
            $this->setError('An error occurred while adding the room');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $room = $this->roomModel->find($id);
        
        if (!$room) {
            $this->setError('Room not found');
            return redirect()->to('/rooms');
        }

        $data = [
            'page_title' => 'Edit Room',
            'breadcrumb' => ['Dashboard' => '/', 'Rooms' => '/rooms', 'Edit'],
            'room' => $room,
        ];

        return $this->render('rooms/edit', $data);
    }

    public function update($id)
    {
        $room = $this->roomModel->find($id);
        
        if (!$room) {
            if ($this->isAjax()) {
                return $this->sendError('Room not found', 404);
            }
            $this->setError('Room not found');
            return redirect()->to('/rooms');
        }

        $rules = [
            'room_no' => 'required|min_length[1]|max_length[50]|is_unique[room_list.room_no,id,' . $id . ']',
            'room_type' => 'required|in_list[classroom,laboratory,library,auditorium,other]',
            'capacity' => 'permit_empty|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'room_no' => $this->request->getPost('room_no'),
                'room_type' => $this->request->getPost('room_type'),
                'capacity' => $this->request->getPost('capacity'),
                'description' => $this->request->getPost('description'),
                'is_active' => $this->request->getPost('is_active') ?? 'yes',
                'updated_at' => date('Y-m-d'),
            ];

            $result = $this->roomModel->update($id, $data);

            if ($result) {
                if ($this->isAjax()) {
                    return $this->sendSuccess([], 'Room updated successfully!');
                }
                $this->setSuccess('Room updated successfully!');
                return redirect()->to('/rooms');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to update room');
                }
                $this->setError('Failed to update room');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Room update error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while updating the room');
            }
            $this->setError('An error occurred while updating the room');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/rooms');
        }

        $csrf = $this->validateCSRF();
        if ($csrf !== true) {
            return $csrf;
        }

        try {
            $room = $this->roomModel->find($id);
            
            if (!$room) {
                return $this->sendError('Room not found', 404);
            }

            $result = $this->roomModel->delete($id);

            if ($result) {
                return $this->sendSuccess([], 'Room deleted successfully!');
            } else {
                return $this->sendError('Failed to delete room');
            }

        } catch (\Exception $e) {
            log_message('error', 'Room deletion error: ' . $e->getMessage());
            return $this->sendError('An error occurred while deleting the room');
        }
    }

    public function schedule($id)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/rooms');
        }

        try {
            $room = $this->roomModel->find($id);
            
            if (!$room) {
                return $this->sendError('Room not found', 404);
            }

            // This is a placeholder for room scheduling functionality
            // In a real implementation, you would fetch class schedules, time tables, etc.
            $schedule = [
                'room' => $room,
                'schedules' => [] // Placeholder for actual schedule data
            ];

            return $this->sendSuccess($schedule);

        } catch (\Exception $e) {
            log_message('error', 'Room schedule error: ' . $e->getMessage());
            return $this->sendError('An error occurred while fetching room schedule');
        }
    }
}
