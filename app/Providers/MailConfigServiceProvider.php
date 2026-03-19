<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
class MailConfigServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        //
    }

    
    public function boot(): void
    {
        try {
            $mailSetting = MailSetting::first();
            
            if ($mailSetting) {
                Config::set('mail.default', $mailSetting->mail_mailer);                
                if ($mailSetting->mail_mailer === 'smtp') {
                    Config::set('mail.mailers.smtp', [
                        'transport' => $mailSetting->mail_mailer,
                        'host' => $mailSetting->mail_host,
                        'port' => (int) $mailSetting->mail_port,
                        'encryption' => $mailSetting->mail_encryption,
                        'username' => $mailSetting->mail_username,
                        'password' => $mailSetting->mail_password,
                        'timeout' => null,
                        'auth_mode' => null,
                    ]);
                }
                
                Config::set('mail.from', [
                    'address' => $mailSetting->mail_from_address,
                    'name' => $mailSetting->mail_from_name,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to load mail settings from database: ' . $e->getMessage());
        }
    }
}