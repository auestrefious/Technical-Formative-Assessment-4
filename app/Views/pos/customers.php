<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ACCOUNTS</p>
    <h1>Customer Accounts</h1>
    <p>Manage customer names and contact details.</p>
    <div class="actions">
        <a class="button primary" href="<?= site_url('customers/new') ?>">New Customer</a>
    </div>
</section>

<div class="table-card">
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= esc($customer['full_name']) ?></td>
                        <td><?= esc($customer['email']) ?></td>
                        <td><?= esc($customer['phone']) ?></td>
                        <td><a class="table-link" href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                    </tr>
                <?php endforeach ?>
                <?php if ($customers === []): ?>
                    <tr><td colspan="4">No customer accounts yet.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('templates/footer') ?>
