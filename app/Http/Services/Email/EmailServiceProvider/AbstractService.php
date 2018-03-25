<?php
namespace App\Http\Services\Email\EmailServiceProvider;

use Illuminate\Support\Facades\Mail;

abstract class AbstractService
{
    protected $transport;

    public function setDriver()
    {
        $driver = new \Swift_Mailer($this->transport);
        Mail::setSwiftMailer($driver);

    }
}
