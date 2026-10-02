<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ACCOUNTS</p>
    <h1>User Accounts</h1>
    <p>Manage staff accounts and profile pictures.</p>
    <div class="actions">
        <a class="button primary" href="<?= site_url('users/new') ?>">New User</a>
    </div>
</section>

<div class="table-card">
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php
                    $filename = basename((string) ($user['avatar'] ?? ''));
                    $avatarPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars'
                        . DIRECTORY_SEPARATOR . $filename;
                    $hasAvatar = preg_match('/\A[a-zA-Z0-9_-]+\.(?:jpe?g|png)\z/i', $filename) === 1
                        && is_file($avatarPath);
                    $avatarUrl = $hasAvatar
                        ? base_url('uploads/avatars/' . rawurlencode($filename))
                        : base_url('images/avatar-placeholder.svg');
                    ?>
                    <tr>
                        <td>
                            <img class="avatar-image" src="<?= esc($avatarUrl, 'attr') ?>"
                                alt="Profile picture of <?= esc($user['full_name'], 'attr') ?>"
                                width="48" height="48">
                        </td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['full_name']) ?></td>
                        <td><?= esc($user['created_at']) ?></td>
                        <td><a class="table-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                    </tr>
                <?php endforeach ?>
                <?php if ($users === []): ?>
                    <tr><td colspan="5">No user accounts yet.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('templates/footer') ?>
