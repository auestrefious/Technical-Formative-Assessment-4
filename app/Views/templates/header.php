<?php helper('form'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'POS') ?> | SimplePOS</title>
    <link rel="stylesheet" href="<?= base_url('css/pos.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="nav-wrap">
            <a class="brand" href="<?= site_url('/') ?>">SimplePOS</a>
            <nav aria-label="Main navigation">
                <a href="<?= site_url('/') ?>">Home</a>
                <a href="<?= site_url('about') ?>">About</a>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a href="<?= site_url('users') ?>">Users</a>
                <?php if (session('user_id')): ?>
                    <form class="nav-logout" action="<?= esc(site_url('logout'), 'attr') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit">Log out</button>
                    </form>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>">Log in</a>
                <?php endif ?>
            </nav>
        </div>
    </header>
    <main class="container">
