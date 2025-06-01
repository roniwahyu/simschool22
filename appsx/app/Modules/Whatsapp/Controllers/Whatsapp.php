<?php

namespace App\Modules\Whatsapp\Controllers;

use App\Controllers\BaseController;
use App\Modules\Whatsapp\Models\Whatsapp;

class Whatsapp extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Whatsapp();
    }

    public function index()
    {
        $data = [
            'title' => 'Whatsapp Management',
            'records' => $this->model->findAll()
        ];

        return view('App\Modules\Whatsapp\Views\index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Whatsapp',
            'validation' => \Config\Services::validation()
        ];

        return view('App\Modules\Whatsapp\Views\create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        
        if ($this->model->insert($data)) {
            return redirect()->to('/Whatsapp')->with('success', 'Whatsapp created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create Whatsapp');
        }
    }

    public function edit($id)
    {
        $record = $this->model->find($id);
        
        if (!$record) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Record not found');
        }

        $data = [
            'title' => 'Edit Whatsapp',
            'record' => $record,
            'validation' => \Config\Services::validation()
        ];

        return view('App\Modules\Whatsapp\Views\edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/Whatsapp')->with('success', 'Whatsapp updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update Whatsapp');
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            return redirect()->to('/Whatsapp')->with('success', 'Whatsapp deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Whatsapp');
        }
    }

    public function api_list()
    {
        return $this->response->setJSON($this->model->findAll());
    }
}