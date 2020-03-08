<?php

use Illuminate\Database\Seeder;
use App\Setting;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create default sidebar mini
        Setting::create([
            'name'      =>  'default_sidebar',
            'value'     =>  '0',
        ]);

        //  Create default Date Format
        Setting::create([
            'name'      =>  'date_format',
            'value'     =>  'd-m-Y',
        ]);

        //  Create default Time Format
        Setting::create([
            'name'      =>  'time_format',
            'value'     =>  'h:i A',
        ]);

        //  Create default notification_format
        Setting::create([
            'name'      =>  'notification_format',
            'value'     =>  'toast-top-right',
        ]);

        //  Create default timezone
        Setting::create([
            'name'      =>  'timezone',
            'value'     =>  'Asia/Dhaka',
        ]);
    }
}
