<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table         = 'employees';
    protected $primaryKey    = 'ID';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
        'gender',
        'email',
        'phone_number',
        'address',
        'username',
        'password',
        'department',
    ];

    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}