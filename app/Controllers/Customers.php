<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data = [
            'customers' => $customerModel->findAll()
        ];

        return view('customers/index', $data);
        
    }
public function new()
{
    helper('form');
    return view('customers/new');
}
public function create()
{
    $data = $this->request->getPost();

    if (! $this->validateData($data, [
        'full_name' => 'required',
        'email'     => 'required|valid_email',
    ])) {
        return redirect()->back()->withInput();
    }

    (new CustomerModel())->insert($this->validator->getValidated());

    return redirect()->to('/customers');
}
}
