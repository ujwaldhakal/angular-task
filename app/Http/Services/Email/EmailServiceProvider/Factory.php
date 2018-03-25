<?php
namespace App\Http\Services\Email\EmailServiceProvider;

use App\Http\Services\Email\EmailServiceProvider\Mailgun;
use App\Http\Services\Email\EmailServiceProvider\Spark;

class Factory
{
    public static function create($provider)
    {
        if($provider == 'mailgun') {
            return new Mailgun();
        }
        // update here if you have more mail service providers
    }
}
