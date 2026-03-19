<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        $setting = MailSetting::first();
        if (!$setting) {
            $setting = new MailSetting();
        }
        return view('backend.pages.setting.smtp-mail.update', compact('setting'));
    }

    public function update(Request $request, $id = null)
    {
        try {
            $validated = $request->validate([
                'mail_mailer'       => 'required|in:smtp,sendmail',
                'mail_host'         => 'nullable|string',
                'mail_port'         => 'nullable|numeric',
                'mail_username'     => 'nullable|string',
                'mail_password'     => 'nullable|string',
                'mail_encryption'   => 'nullable|in:tls,ssl',
                'mail_from_address' => 'required|email',
                'mail_from_name'    => 'required|string|max:255',
            ]);
            DB::beginTransaction();
            $setting = MailSetting::first();
            if (!$setting) {
                $setting = new MailSetting();
            }
            if (!$request->filled('mail_password')) {
                unset($validated['mail_password']);
            }

            $setting->fill($validated);
            $setting->save();
            $this->updateEnvFile($validated);
            Artisan::call('config:clear');
            DB::commit();

            return back()->with('success', 'Mail settings updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function updateEnvFile($data)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str = $this->setEnvValue($str, 'MAIL_MAILER', $data['mail_mailer'] ?? 'smtp');
        if (isset($data['mail_host'])) {
            $str = $this->setEnvValue($str, 'MAIL_HOST', $data['mail_host']);
        }
        if (isset($data['mail_port'])) {
            $str = $this->setEnvValue($str, 'MAIL_PORT', $data['mail_port']);
        }
        if (isset($data['mail_username'])) {
            $str = $this->setEnvValue($str, 'MAIL_USERNAME', $data['mail_username']);
        }
        if (isset($data['mail_password'])) {
            $str = $this->setEnvValue($str, 'MAIL_PASSWORD', $data['mail_password']);
        }
        if (isset($data['mail_encryption'])) {
            $str = $this->setEnvValue($str, 'MAIL_ENCRYPTION', $data['mail_encryption']);
        }
        if (isset($data['mail_from_address'])) {
            $str = $this->setEnvValue($str, 'MAIL_FROM_ADDRESS', $data['mail_from_address']);
        }
        if (isset($data['mail_from_name'])) {
            $str = $this->setEnvValue($str, 'MAIL_FROM_NAME', '"' . $data['mail_from_name'] . '"');
        }
        file_put_contents($envFile, $str);
    }

    /**
     * Set or update .env value
     */
    private function setEnvValue($str, $key, $value)
    {
        $pattern = "/^{$key}=.*/m";

        if (preg_match($pattern, $str)) {
            return preg_replace($pattern, "{$key}={$value}", $str);
        }

        return $str . "\n{$key}={$value}";
    }
}
