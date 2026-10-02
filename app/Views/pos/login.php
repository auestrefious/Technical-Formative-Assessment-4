<?php helper('form'); ?>
<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ACCOUNT ACCESS</p>
    <h1>Log in to SimplePOS</h1>
    <p>Enter the username and password for your user account.</p>
</section>

<div class="form-card">
    <?php if (session('error')): ?>
        <p class="form-error" role="alert"><?= esc(session('error')) ?></p>
    <?php endif ?>

    <form action="<?= esc(site_url('login'), 'attr') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-field">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength="50"
                value="<?= esc((string) (session('login_username') ?? ''), 'attr') ?>"
                autocomplete="username" required>
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password"
                autocomplete="current-password" required>
        </div>
        <button class="button primary" type="submit">Log in</button>
    </form>
</div>

<?= $this->include('templates/footer') ?>
