<?php

namespace App\Modules\Whatsapp\Models;

use CodeIgniter\Model;

class Whatsapp extends Model
{
    protected $table = 'whatsapps';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'number', 'message', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [

    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}