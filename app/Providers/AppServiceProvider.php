<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('not_present', function($attribute, $value, $parameters)
        {
            return false;
        });

        Validator::extend('not_present_with', function($attribute, $value, $parameters)
        {
            return is_null($value) || is_null($this->getValue($parameters[0]));
        });

        /*
         * Validates only alphabetic and spaces
         */
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        /*
         * Validates only alphabetic and spaces
         */
        Validator::extend('alpha_number_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s\d]+$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
