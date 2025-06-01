<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'room_list';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'room_no', 'room_type', 'capacity', 'description', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'room_no' => 'required|min_length[1]|max_length[50]',
        'room_type' => 'required|in_list[classroom,laboratory,library,auditorium,other]',
        'capacity' => 'permit_empty|integer|greater_than[0]'
    ];

    protected $validationMessages = [
        'room_no' => [
            'required' => 'Room number is required',
            'min_length' => 'Room number must be at least 1 character',
            'max_length' => 'Room number cannot exceed 50 characters'
        ],
        'room_type' => [
            'required' => 'Room type is required',
            'in_list' => 'Room type must be one of: classroom, laboratory, library, auditorium, other'
        ],
        'capacity' => [
            'integer' => 'Capacity must be a number',
            'greater_than' => 'Capacity must be greater than 0'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get all active rooms
     */
    public function getActiveRooms()
    {
        return $this->where('is_active', 'yes')
                   ->orderBy('room_no', 'ASC')
                   ->findAll();
    }

    /**
     * Get rooms by type
     */
    public function getRoomsByType($type)
    {
        return $this->where('room_type', $type)
                   ->where('is_active', 'yes')
                   ->orderBy('room_no', 'ASC')
                   ->findAll();
    }

    /**
     * Get room statistics
     */
    public function getRoomStats()
    {
        $stats = [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'inactive' => $this->where('is_active', 'no')->countAllResults(),
        ];

        // Get stats by room type
        $types = ['classroom', 'laboratory', 'library', 'auditorium', 'other'];
        foreach ($types as $type) {
            $stats[$type] = $this->where('room_type', $type)
                                ->where('is_active', 'yes')
                                ->countAllResults();
        }

        // Calculate total capacity
        $totalCapacity = $this->selectSum('capacity')
                             ->where('is_active', 'yes')
                             ->where('capacity IS NOT NULL')
                             ->get()
                             ->getRow()
                             ->capacity ?? 0;

        $stats['total_capacity'] = $totalCapacity;

        return $stats;
    }

    /**
     * Get available rooms for scheduling
     */
    public function getAvailableRooms($date = null, $timeSlot = null)
    {
        // This is a placeholder for room availability checking
        // In a real implementation, this would check against class schedules
        return $this->where('is_active', 'yes')
                   ->orderBy('room_no', 'ASC')
                   ->findAll();
    }

    /**
     * Search rooms
     */
    public function searchRooms($query)
    {
        return $this->groupStart()
                   ->like('room_no', $query)
                   ->orLike('room_type', $query)
                   ->orLike('description', $query)
                   ->groupEnd()
                   ->where('is_active', 'yes')
                   ->limit(10)
                   ->findAll();
    }

    /**
     * Get rooms with utilization data
     */
    public function getRoomsWithUtilization()
    {
        // This is a placeholder for room utilization statistics
        // In a real implementation, this would calculate usage based on schedules
        $rooms = $this->where('is_active', 'yes')->findAll();
        
        foreach ($rooms as &$room) {
            $room['utilization_percentage'] = rand(20, 90); // Placeholder
            $room['weekly_hours'] = rand(10, 40); // Placeholder
        }
        
        return $rooms;
    }

    /**
     * Check if room number is unique
     */
    public function isRoomNoUnique($roomNo, $excludeId = null)
    {
        $builder = $this->where('room_no', $roomNo);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() === 0;
    }
}
