<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;
use App\Models\EmployeeModel;

class Registration extends BaseController
{
    public function index(): string
    {
        return view('userview');
    }

    public function save()
    {
        $rules = [
            'fname'      => 'required|max_length[50]',
            'lname'      => 'required|max_length[50]',
            'Mname'      => 'required|max_length[50]',
            'Bdate'      => 'required|valid_date[Y-m-d]',
            'gender'     => 'required|in_list[male,female]',
            'email'      => 'required|valid_email|max_length[100]',
            'pnum'       => 'required|max_length[20]',
            'address'    => 'required|max_length[100]',
            'Uname'      => 'required|min_length[3]|max_length[50]',
            'pass'       => 'required|min_length[8]|max_length[255]',
            'department' => 'required|max_length[50]',
            'terms'      => 'required|in_list[1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $employeeModel = new EmployeeModel();
        try {
            $inserted = $employeeModel->insert([
                'first_name'   => trim((string) $this->request->getPost('fname')),
                'last_name'    => trim((string) $this->request->getPost('lname')),
                'middle_name'  => trim((string) $this->request->getPost('Mname')),
                'birthdate'    => $this->request->getPost('Bdate'),
                'gender'       => $this->request->getPost('gender'),
                'email'        => trim((string) $this->request->getPost('email')),
                'phone_number' => trim((string) $this->request->getPost('pnum')),
                'address'      => trim((string) $this->request->getPost('address')),
                'username'     => trim((string) $this->request->getPost('Uname')),
                'password'     => (string) $this->request->getPost('pass'),
                'department'   => trim((string) $this->request->getPost('department')),
            ]);
        } catch (DatabaseException $exception) {
            log_message('error', 'Registration insert failed: ' . $exception->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('errors', ['registration' => 'Registration could not be saved. Please try again.']);
        }

        if ($inserted === false) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['registration' => 'Registration could not be saved. Please try again.']);
        }

        return redirect()->to(site_url('register'))->with('success', 'Registration completed successfully.');
    }
}
