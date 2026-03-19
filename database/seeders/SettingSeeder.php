<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MailSetting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        MailSetting::updateOrCreate(
            ['id' => 1],
            [
                'mail_mailer'       => 'sendmail',
                'mail_host'         => null,
                'mail_port'         => null,
                'mail_username'     => null,
                'mail_password'     => null,
                'mail_encryption'   => null,
                'mail_from_address' => 'heterowizard@makizpharma.moscow',
                'mail_from_name'    => "Hetero World",
            ]
        );
    }
}
