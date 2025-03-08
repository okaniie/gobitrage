# Getting Started

Congratulations on your acquisition of this script. This is an introduction on how to get started.

In order to run this script, you need to have a webserver that can run PHP code. 

Here are the requirements.

## Requirements
*  8.0 <= PHP < 8.3
* 8.0 <= MySQL

## Pre-run setup
Make a copy of the `.env.example` file into `.env`. Edit the values as needed.

## Running / Developing with docker (recommended)

* If using MySQL from your local machine, update your `.env` to `DB_HOST=host.docker.internal`.
* If using MySQL from the docker compose, update your `.env` to `DB_HOST=database`.

To develop with docker, simply run the following command
```bash
bash serve-docker
```

Then visit the homepage to confirm installation `https://yourdomain.com`.

## Steps to run on localhost
If you prefer to run completely on localhost;
1. Make sure your MySQL server is running.
2. Navigate to the project folder and execute the following commands.
```bash
composer install # install dependencies
php artisan migrate # run the database migration
php artisan db:seed # seed the system with some important default data
php artisan serve # lauch the application. Usually live at http://localhost:8000.

```
3. Visit the installation page `http://localhost:8000/install`

## Steps to Deploy on Shared Hosting
To deploy on shared hosting:
1. Create a folder (say `crypto-hyip-online`) outside your webroot folder.
2. Copy / upload all files in `crypto-hyip-pro` folder from your extracted archive into it.
3. Move all contents from `crypto-hyip-pro/public` into your webroot  folder (`public_html` or `www` depending on your hosting company).
4. If you have obtained a theme, upload the folder to `crypto-hyip-online/themes/your-theme-name`. Also copy the content of the public folder to `public_html/themes/your-theme-name`
5. Edit `public_html/index.php` and do the following replacements.

```php
// from 
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}
// to
if (file_exists($maintenance = __DIR__.'/../crypto-hyip-online/storage/framework/maintenance.php')) {
    require $maintenance;
}

// from
require __DIR__.'/../vendor/autoload.php';

// to
require __DIR__.'/../crypto-hyip-online/vendor/autoload.php';


// from 
$app = require_once __DIR__.'/../bootstrap/app.php';

// to 
$app = require_once __DIR__.'/../crypto-hyip-online/bootstrap/app.php';

```

5. Create a database, take note of the database `username`, `password`, `database name`.

6. Navigate to `https://yourdomain.com/install` to begin the installation process. Follow the guide and make replacements as necessary when it gets to Environment Variable files. Make sure to put your website address as the `APP_URL`, as well as the database details. If you obtained a new theme, update the value of current theme to `CURRENT_THEME=your-theme-name` for it to take effect. Click the button to continue.

7. Once installation is completed, you can go ahead and visit the signup page. The first account created will be assigned as the `admin` of the website. **Please use a very secure password here.**

8. Set your cron job as follows...
```
*/5 * * * * cd /home/path/to/project && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1

```
That is set to run once every 5 minutes. Please note that `minutely` plans in the admin panel will not work on shared hosting. So let your pricing plans start from hourly.


You can then proceed to [Admin Documentation](../02-admin-dashboard/README.md) to learn about the admin interface.

## Steps to Deploy on VPS

