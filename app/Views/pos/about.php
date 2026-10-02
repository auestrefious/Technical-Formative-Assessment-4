<?= $this->include('templates/header') ?>

<section class="page-heading">
    <p class="eyebrow">ABOUT THE PROJECT</p>
    <h1>About SimplePOS</h1>
    <p>SimplePOS is a CodeIgniter 4 point-of-sale project that uses MVC and a MySQL database to manage customer and user accounts. Staff can sign in to access the account pages.</p>
</section>

<section class="card">
    <h2>Current features</h2>
    <ul class="feature-list">
        <li>Customer and user records loaded from MySQL through CodeIgniter models</li>
        <li>Forms to create and edit customer accounts, with required name and valid email checks</li>
        <li>Forms to create and edit user accounts, with required name and unique username checks</li>
        <li>Optional JPG or PNG profile pictures up to 2 MB, prepared as 300 &times; 300 thumbnails in public uploads</li>
        <li>Avatar filenames saved in the users table; the User Accounts page shows each picture or a placeholder</li>
        <li>Passwords stored as hashes and checked when a user logs in</li>
        <li>Sessions keep users signed in while they use the application</li>
        <li>Customer and user pages, including their new and edit forms, require login</li>
        <li>Logging out ends the session and returns the user to the login page</li>
        <li>Reusable header and footer templates</li>
        <li>Responsive styling for desktop and mobile screens</li>
    </ul>
</section>

<?= $this->include('templates/footer') ?>
