<?php
namespace Services\Email\EmailServiceProvider;

class Factory
{
    public static function create($provider)
    {
        if($provider == 'mailtrap') {
            return new Mailtrap();
        }
        else if($provider == 'mailgun') {
            return new Mailgun();
        }
    }
}
