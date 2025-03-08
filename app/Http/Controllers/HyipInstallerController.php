<?php

namespace App\Http\Controllers;

set_time_limit(0);

use App\Http\Requests\HyipInstallerRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class HyipInstallerController extends Controller
{
    private $fields = [
        'INSTALLED',
        // 'INSTALLER_PASSWORD',
        // 'LICENSE_KEY',
        'APP_NAME',
        'APP_ENV',
        'APP_KEY',
        'APP_DEBUG',
        'APP_URL',
        'APP_TIMEZONE',
        'DB_CONNECTION',
        'DB_HOST',
        'DB_PORT',
        'DB_DATABASE',
        'DB_USERNAME',
        'DB_PASSWORD',
        'MAIL_MAILER',
        'MAIL_HOST',
        'MAIL_PORT',
        'MAIL_USERNAME',
        'MAIL_PASSWORD',
        'MAIL_ENCRYPTION',
        'MAIL_FROM_ADDRESS',
        'MAIL_FROM_NAME',
        'ACTIVE_THEME',
        'SITE_NAME',
        'SITE_DESCRIPTION',
        'SITE_EMAIL',
        'SITE_ADDRESS',
    ];

    private $initData = [
        // 'INSTALLER_PASSWORD' => '',
        // 'LICENSE_KEY' => '',
        'APP_ENV' => 'dev',
        'APP_DEBUG' => true,
        'APP_TIMEZONE' => 'Europe/London',
        'DB_CONNECTION' => 'mysql',
        'DB_HOST' => 'localhost',
        'DB_PORT' => 3306,
        'DB_DATABASE' => 'database',
        'DB_USERNAME' => 'username',
        'DB_PASSWORD' => 'password',
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'smtp.mailtrap.io',
        'MAIL_PORT' => 2525,
        'MAIL_USERNAME' => '',
        'MAIL_PASSWORD' => '',
        'MAIL_ENCRYPTION' => null,
        'MAIL_FROM_ADDRESS' => '',
        'MAIL_FROM_NAME' => 'Support',
        'ACTIVE_THEME' => 'default-theme',
        'SITE_NAME' => 'Crypto Hyip Pro',
        'SITE_DESCRIPTION' => '',
        'SITE_EMAIL' => '',
        'SITE_ADDRESS' => '',
        'SITE_PHONE1' => '',
        'SITE_PHONE2' => '',
    ];

    private $mustQuote = [
        'APP_NAME',
        'DB_PASSWORD',
        'SITE_NAME',
        'SITE_DESCRIPTION',
        'SITE_EMAIL',
        'SITE_ADDRESS',
        'SITE_PHONE1',
        'SITE_PHONE2',
        'MAIL_PASSWORD',
        'MIX_PUSHER_APP_KEY',
        'MIX_PUSHER_APP_CLUSTER',
        // 'INSTALLER_PASSWORD',
        // 'LICENSE_KEY'
    ];

    public function step1Init()
    {
        $parsedEnv = $this->parseEnv();
        if ($parsedEnv['INSTALLED'] == "true") abort(404, "not found");

        return view(
            'hyipinstaller.step1',
            array_merge(
                $this->initData,
                ['INSTALLED_THEMES' => $this->getInstalledThemes()]
            )
        );
    }

    public function step1Complete(HyipInstallerRequest $request)
    {
        $parsedEnv = $this->parseEnv();
        if ($parsedEnv['INSTALLED'] == "true") abort(404, "not found");

        // generate key
        $this->generateNewKey();

        foreach ($request->all() as $key => $value) {
            if (!isset($parsedEnv[$key]) || empty($value)) continue;
            $parsedEnv[$key] = $value;
        }

        // Put app url
        $parsedEnv['APP_URL'] = url('/');

        // installed = true
        $parsedEnv['INSTALLED'] = 'true';

        // appname
        $parsedEnv['APP_NAME'] = $request->SITE_NAME;

        // installer password
        // $parsedEnv['INSTALLER_PASSWORD'] = Hash::make($request->INSTALLER_PASSWORD);

        // // license key
        // $parsedEnv['LICENSE_KEY'] = Hash::make($request->LICENSE_KEY);

        $semiFinalEnv = [];

        foreach ($parsedEnv as $key => $value) {
            if (in_array($key, $this->mustQuote)) {
                $semiFinalEnv[] = "{$key}=\"{$value}\"";
            } else {
                $semiFinalEnv[] = "{$key}={$value}";
            }
        }

        $final = trim(implode("\r\n", $semiFinalEnv));

        file_put_contents(base_path('.env'), $final);

        return redirect(route('installer.step2'));
    }

    public function step2Init()
    {
        $parsedEnv = $this->parseEnv();
        if ($parsedEnv['INSTALLED'] !== "true") abort(404, "not found");

        return view('hyipinstaller.step2');
    }

    public function step2Complete()
    {
        $this->migrateDb();
        $this->seedDb();
        return redirect(route('installer.step3'));
    }

    public function step3Init()
    {
        return view('hyipinstaller.step3');
    }

    public function getInstalledThemes()
    {
        $response = [];

        $dirs = scandir(base_path('themes'));

        foreach ($dirs as $dir) {
            if (!in_array($dir, ['.', '..', 'index.php'])) {
                $response[] = $dir;
            }
        }

        return $response;
    }

    private function migrateDb()
    {
        Artisan::call("migrate");
    }

    private function seedDb()
    {
        Artisan::call("db:seed");
    }

    private function generateNewKey()
    {
        Artisan::call("key:generate");
        sleep(2);
    }

    private function parseEnv(): array
    {
        $envContents = explode("\n", file_get_contents(base_path('.env')));
        $parsedEnv = [];

        foreach ($envContents as $cont) {

            if (empty($cont)) continue;
            $cont = trim($cont);
            $contExploded = explode("=", $cont);
            $key = $contExploded[0];
            array_shift($contExploded);
            $value = implode("=", $contExploded);
            $parsedEnv[$key] = trim($value, "\"");
        }

        return $parsedEnv;
    }
}
