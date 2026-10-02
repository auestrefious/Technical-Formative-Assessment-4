-- Import this file ONLY if the users table does not already have an avatar column.
ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NULL DEFAULT NULL;
