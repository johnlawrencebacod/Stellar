<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['username', 'email', 'password', 'first_name', 'last_name', 
    'middle_name', 'birthdate', 'gender', 'phone_number', 'address'];

    protected $useTimestamps = true;   // fills created_at / updated_at

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[30]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
    ];
    protected $validationMessages = [
        'email' => ['is_unique' => 'That email is already taken.'],
    ];

    // Hash password right before it hits the DB
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}