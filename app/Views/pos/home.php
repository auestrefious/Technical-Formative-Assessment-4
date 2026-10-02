<?= $this->include('templates/header') ?>

<section class="hero">
    <p class="eyebrow">POINT-OF-SALE SYSTEM</p>
    <h1>Manage your store in one simple place.</h1>
    <p>This first version demonstrates CodeIgniter routes, a controller, views, and temporary array data.</p>
    <div class="actions">
        <a class="button primary" href="<?= site_url('customers') ?>">View Customers</a>
        <a class="button secondary" href="<?= site_url('users') ?>">View Users</a>
    </div>
</section>

<section class="card-grid">
    <article class="card">
        <h2>Customer Accounts</h2>
        <p>See customer names, email addresses, and phone numbers.</p>
    </article>
    <article class="card">
        <h2>User Accounts</h2>
        <p>See staff usernames, full names, and assigned roles.</p>
    </article>
</section>

<?= $this->include('templates/footer') ?>
