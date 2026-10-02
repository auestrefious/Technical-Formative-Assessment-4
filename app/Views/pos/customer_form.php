<?php
helper('form');
$editing = isset($customer);
?>
<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ACCOUNTS</p>
    <h1><?= $editing ? 'Edit Customer' : 'New Customer' ?></h1>
</section>

<div class="form-card">
    <?= validation_list_errors() ?>
    <?php if (session('error')): ?>
        <p class="form-error" role="alert"><?= esc(session('error')) ?></p>
    <?php endif ?>

    <form action="<?= esc(site_url($editing ? 'customers/' . $customer['id'] . '/edit' : 'customers/new'), 'attr') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-field">
            <label for="full_name">Full name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100"
                value="<?= old('full_name', $customer['full_name'] ?? '', 'attr') ?>" required>
        </div>

        <div class="form-field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" maxlength="100"
                value="<?= old('email', $customer['email'] ?? '', 'attr') ?>" required>
        </div>

        <div class="form-field">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="text" maxlength="20"
                value="<?= old('phone', $customer['phone'] ?? '', 'attr') ?>">
        </div>

        <div class="form-actions">
            <button class="button primary" type="submit">Save customer</button>
            <a class="button secondary" href="<?= site_url('customers') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->include('templates/footer') ?>
