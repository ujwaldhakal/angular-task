<?php
namespace Services\Email\EmailServiceProvider;

class Mailgun
{
    public function changeDriver()
    {
        config([
            'mail' => [
                'driver' => 'mailgun',
                'host' => 'customer-host',
                'username' => 'customer-username',
                'password' => 'customer-password',
            ],
        ]);
    }
}
