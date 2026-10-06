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
        'full_name' => 'required|max_length[100]',
        'email'     => 'required|valid_email|max_length[100]',
    ])) {
        return redirect()->back()->withInput();
    }

    (new CustomerModel())->insert($this->validator->getValidated());

    return redirect()->to('/customers');
}
public function edit(int $id)
{
    $customer = (new CustomerModel())->find($id);
    if (! $customer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    return view('customers/edit', ['customer' => $customer]);
}
public function update(int $id)
{
    $model = new CustomerModel();
    if (! $model->find($id)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    $data = $this->request->getPost();
    if (! $this->validateData($data, [
        'full_name' => 'required|max_length[100]',
        'email' => 'required|valid_email|max_length[100]',
        'phone' => 'permit_empty|max_length[20]',
    ])) {
        return redirect()->back()->withInput();
    }
    $model->update($id, $this->validator->getValidated());
    return redirect()->to('/customers');
}
}
