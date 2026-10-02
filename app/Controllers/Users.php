<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        return view('pos/users', [
            'title' => 'User Accounts',
            'users' => $model->select('id, username, full_name, avatar, created_at')->findAll(),
        ]);
    }

    public function newForm()
    {
        return view('pos/user_form', ['title' => 'New User']);
    }

    public function create()
    {
        $input = [
            'username'         => trim((string) $this->request->getPost('username')),
            'full_name'        => trim((string) $this->request->getPost('full_name')),
            'password'         => (string) $this->request->getPost('password'),
            'password_confirm' => (string) $this->request->getPost('password_confirm'),
        ];

        $rules = [
            'username'         => 'required|max_length[50]|is_unique[users.username]',
            'full_name'        => 'required|max_length[100]',
            'password'         => 'required|min_length[8]|max_length[72]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validateData($input, $rules)) {
            return $this->backToUserForm($input);
        }

        $data = [
            'username'   => $input['username'],
            'full_name'  => $input['full_name'],
            'password'   => password_hash($input['password'], PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $model = new UserModel();

        if ($model->insert($data) === false) {
            return $this->backToUserForm($input, 'User could not be saved.');
        }

        return redirect()->to(site_url('users'));
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('pos/user_form', [
            'title' => 'Edit User',
            'user'  => $user,
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $input = [
            'username'         => trim((string) $this->request->getPost('username')),
            'full_name'        => trim((string) $this->request->getPost('full_name')),
            'password'         => (string) $this->request->getPost('password'),
            'password_confirm' => (string) $this->request->getPost('password_confirm'),
        ];

        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        if ($input['password'] !== '' || $input['password_confirm'] !== '') {
            $rules['password'] = 'required|min_length[8]|max_length[72]';
            $rules['password_confirm'] = 'required|matches[password]';
        }

        if (! $this->validateData($input, $rules)) {
            return $this->backToUserForm($input);
        }

        $data = [
            'username'  => $input['username'],
            'full_name' => $input['full_name'],
        ];

        if ($input['password'] !== '') {
            $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        $file = $this->request->getFile('avatar');
        $newAvatarPath = null;

        // Keep the existing avatar if the edit form did not include a new file.
        if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $file->isValid()) {
                return $this->backToUserForm($input, 'The picture could not be uploaded. Select a JPG or PNG under 2 MB.');
            }

            $avatarRules = [
                'avatar' => 'uploaded[avatar]|is_image[avatar]'
                    . '|mime_in[avatar,image/jpeg,image/png]'
                    . '|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]',
            ];

            if (! $this->validateData([], $avatarRules)) {
                return $this->backToUserForm($input);
            }

            $avatarDirectory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';
            try {
                if (! is_dir($avatarDirectory) && ! mkdir($avatarDirectory, 0755, true)
                    && ! is_dir($avatarDirectory)) {
                    throw new \RuntimeException('Unable to create the avatars directory.');
                }

                // Move first, then replace the upload with a 300 x 300 thumbnail.
                $file->move($avatarDirectory, $file->getRandomName());
                $newAvatarPath = $avatarDirectory . DIRECTORY_SEPARATOR . $file->getName();

                if (! service('image')->withFile($newAvatarPath)
                    ->fit(300, 300, 'center')->save($newAvatarPath)) {
                    throw new \RuntimeException('Unable to save the avatar thumbnail.');
                }
            } catch (\Throwable $e) {
                if ($newAvatarPath !== null && is_file($newAvatarPath)) {
                    unlink($newAvatarPath);
                }

                log_message('error', 'Avatar processing failed: ' . $e->getMessage());

                return $this->backToUserForm($input, 'The picture could not be prepared. Check PHP GD and folder permissions.');
            }

            // The database holds a filename, not a full filesystem path.
            $data['avatar'] = $file->getName();
        }

        if ($model->update($id, $data) === false) {
            if ($newAvatarPath !== null && is_file($newAvatarPath)) {
                unlink($newAvatarPath);
            }

            return $this->backToUserForm($input, 'User could not be updated.');
        }

        return redirect()->to(site_url('users'));
    }

    private function backToUserForm(array $input, ?string $error = null)
    {
        // Keep the user's non-secret fields, but never put a password in flashdata.
        $redirect = redirect()->back()->with('user_form_values', [
            'username'  => $input['username'],
            'full_name' => $input['full_name'],
        ]);

        $errors = service('validation')->getErrors();
        if ($errors !== []) {
            $redirect->with('user_form_errors', $errors);
        }

        if ($error !== null) {
            $redirect->with('error', $error);
        }

        return $redirect;
    }
}
