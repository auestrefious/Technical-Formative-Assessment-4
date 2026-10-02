POS account and avatar update
=============================

These files were updated against the codeigniter.zip you supplied.

1. Extract this ZIP. Copy its app and public folders into:
   C:\xampp\htdocs\codeigniter
   Allow Windows to replace the matching files. Keep your existing
   public\uploads\avatars folder and its pictures.

2. In phpMyAdmin, open the users table and check its Structure tab. If
   there is no avatar column, import database\add_avatar_column.sql once.
   If the column already exists, skip the SQL file.

3. PHP GD must be enabled for thumbnail preparation. After enabling it,
   restart the PHP server that runs this project (and Apache if using it).

4. Open http://localhost:8080/index.php/users. The Profile column shows
   avatars; Edit opens the upload form. Try a JPG/PNG under 2 MB. Users
   without an avatar show the included placeholder image. The New User,
   New Customer, and Edit links are on the account listing pages.

If an older uploaded picture shows the placeholder, check the avatar
value in that user's database row. It must be the filename already in
public\uploads\avatars, without any folders or URL before it.
