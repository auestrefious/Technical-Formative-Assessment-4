<?php

namespace App\Commands;

use App\Models\UserModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SetUserPasswords extends BaseCommand
{
    protected $group = 'Accounts';
    protected $name = 'auth:passwords';
    protected $description = 'Generate temporary passwords for existing users without one.';
    protected $usage = 'auth:passwords [username]';

    public function run(array $params)
    {
        if (count($params) > 1) {
            CLI::error('Usage: php spark auth:passwords [username]');
            return;
        }

        $model = new UserModel();
        if (isset($params[0])) {
            // Supplying a username explicitly resets that account's password.
            $user = $model->where('username', $params[0])->first();
            if ($user === null) {
                CLI::error('No user has that username.');
                return;
            }
            $users = [$user];
        } else {
            // Re-running this command leaves accounts with passwords unchanged.
            $users = $model->where('password', null)->findAll();
        }

        if ($users === []) {
            CLI::write('All existing users already have passwords.');
            return;
        }

        CLI::write('Temporary passwords (shown only now; keep them private):');
        foreach ($users as $user) {
            $temporaryPassword = bin2hex(random_bytes(16));
            $hash = password_hash($temporaryPassword, PASSWORD_DEFAULT);

            if ($model->update($user['id'], ['password' => $hash]) === false) {
                CLI::error('Could not update ' . $user['username'] . '.');
                continue;
            }

            CLI::write($user['username'] . ' : ' . $temporaryPassword);
        }
    }
}
