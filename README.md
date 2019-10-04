# EdPaste

EdPaste is self-hosted Pastebin.

It is a Laravel 5.5 (PHP Framework)-driven self-hosted Pastebin. Demo : https://paste.edra.ovh

## Features :
- Privacy options
- Expiration options
- Burn after reading
- Password protection (server-side hashed)
- User dashboard
- Raw paste viewing
- CAS authentication

Just git clone this repo on your server, make the `public` folder your webserver's `DocumentRoot`, for instance with an Apache2.4 VirtualHost :
```
<VirtualHost *:80>
    ServerName your.vhost.server.com
    DocumentRoot /app/path/public
</VirtualHost>
```
Run a `composer install`/`php composer install` (depends of your configuration) within the app root path (you'll need composer)
Rename `.env.example` to `.env` and run `php artisan key:generate` from the app's root path.
Open `.env` and fill it with your database details
Run `php artisan migrate` from the app's root path, and you're all done.
Copy and adapt CAS configuration from `config/cas.example.php` to `config/cas.php`.

Go to `http://your.vhost.server.com/` which leads to the DocumentRoot `/app/path/public`, and this should work !

# Updating :
Get latest features by pulling this repo again.

In case of updating because of a Laravel version change, delete everything under `bootstrap/cache` and run `composer upgrade`.

# Troubleshooting :
If you get the "Paste expiration error.", then you need to migrate your database. Pastes expiration scheme changed recently, and your database has to be updated. Simply run `php artisan migrate` and everything will be good, without any data loss.

# Contributing :
You're free to fork this and modify it as you want (according to MIT license), but please don't remove my name at the bottom of each page. If you look at the code, you'll notice that all the comments are written in french, as I am a french developer. If you want english comments instead, feel free to ask it, I'll translate all of these.

# Todo :
- Admin panel
- Fix raw view
