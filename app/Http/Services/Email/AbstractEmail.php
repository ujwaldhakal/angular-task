<?php
namespace App\Http\Services\Email;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractEmail
{
    protected $formData;
    protected $params;
    protected $request;
    protected $mailStatus;
    protected $mailerServices = ['mailgun','mailtrap'];

    public function __construct()
    {
        $this->params = new ParameterBag();
    }

    public function send()
    {
       //        while(!$this->isMailSendSuccessfully()) {
           Log::info('testing mail',['testint times']);
            $this->process();
//            sleep(5);
//        }
    }

    public function process()
    {
        Mail::send($this->getTemplate(), ['data' => $this->params], function ($message) {
            $message->subject($this->getSubject());
            $message->from($this->getSender());
            $message->to($this->getReceiver());
        });
    }

    protected function isMailSendSuccessfully()
    {
        $mailStatus = false;
        if (!Mail::failures()) {
            $mailStatus = true;
        }
        return $mailStatus;
    }

    public function getReceiver()
    {
        return env('ADMIN_EMAIL');
    }

    public function getSender()
    {
        return $this->params->get('email');
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setFormData(array $data)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->params->set($key, $value);
            }
        }
    }

}
