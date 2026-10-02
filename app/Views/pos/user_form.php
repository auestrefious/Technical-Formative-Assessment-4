<?php
helper('form');
$editing = isset($user);
?>
<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ACCOUNTS</p>
    <h1><?= $editing ? 'Edit User' : 'New User' ?></h1>
</section>

<div class="form-card">
    <?= validation_list_errors() ?>
    <?php if (session('error')): ?>
        <p class="form-error" role="alert"><?= esc(session('error')) ?></p>
    <?php endif ?>

    <form action="<?= esc(site_url($editing ? 'users/' . $user['id'] . '/edit' : 'users/new'), 'attr') ?>"
        method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-field">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength="50"
                value="<?= old('username', $user['username'] ?? '', 'attr') ?>" required>
        </div>

        <div class="form-field">
            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100"
                value="<?= old('full_name', $user['full_name'] ?? '', 'attr') ?>" required>
        </div>

        <?php if ($editing): ?>
            <div class="form-field">
                <label for="avatar">Profile picture (JPG or PNG, up to 2 MB)</label>
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png">
                <p class="form-hint">Leave this blank to keep the current picture.</p>
            </div>
        <?php endif ?>

        <div class="form-actions">
            <button class="button primary" type="submit">Save user</button>
            <a class="button secondary" href="<?= site_url('users') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->include('templates/footer') ?>
