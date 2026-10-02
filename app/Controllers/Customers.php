<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customerModel->findAll(),
        ];

        return view('pos/customers', $data);
    }

    public function newForm()
    {
        return view('pos/customer_form', ['title' => 'New Customer']);
    }

    public function create()
    {
        $data = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $data['created_at'] = date('Y-m-d H:i:s');

        $model = new CustomerModel();

        if ($model->insert($data) === false) {
            return redirect()->back()->withInput()
                ->with('error', 'Customer could not be saved.');
        }

        return redirect()->to(site_url('customers'));
    }

    public function edit(int $id)
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('pos/customer_form', [
            'title'    => 'Edit Customer',
            'customer' => $customer,
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        if ($model->update($id, $data) === false) {
            return redirect()->back()->withInput()
                ->with('error', 'Customer could not be updated.');
        }

        return redirect()->to(site_url('customers'));
    }
}
