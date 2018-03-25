<?php
namespace App\Http\Services\Email\EmailServiceProvider;

use Illuminate\Support\Facades\Log;
use App\Http\Services\Email\EmailServiceProvider\MailableServiceInterface;
use \Swift_SmtpTransport as SmtpTransport;


class Mailgun extends AbstractService implements MailableServiceInterface
{
    public function changeDriver()
    {
        $this->transport = new SmtpTransport('smtp.mailgun.org', 465, 'ssl');
        $this->transport->setUsername(env('MAILGUN_USERNAME'));
        $this->transport->setPassword(env('MAILGUN_PASSWORD'));
        $this->setDriver();
        $this->log();
    }

    public function log()
    {
        Log::info('Mail driver changed',['Driver' => 'Mailgun']);
    }
}
