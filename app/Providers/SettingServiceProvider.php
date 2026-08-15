<?php

namespace App\Providers;

use App\Models\setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('settings')){
            $settings=setting::firstOrCreate([],
            [
                'logo'=> 'assets/images/settings/logo.png',
                'site_name'=> 'Damitta IP Portal ',
                'site_email'=>'Damittaippoartal@gmail.com',
                'about'=>'This platform represents an integrated system for managing the outputs of scientific research within academic institutions, as it allows researchers to register their work, follow up on the stages of its evaluation, and reach the final decision and document it using blockchain technology, thus ensuring transparency, immutability, and protection of intellectual property rights. ',
                'phone'=>'1234546',
                'country'=>'Egypt' ,
                'city'=>'damitta',
                'street'=>'damitta street',
                'facebook'=>'facebook',
                'linkedin'=>'linkedin',
                'twitter'=>'twitter',
                'github'=>'github',
                       

            ]);

            $settings->whatsapp='https://wa.me/'. $settings->phone ;

            view()->share([
                'settings'=> $settings,
            ]);
        }
    }
}
