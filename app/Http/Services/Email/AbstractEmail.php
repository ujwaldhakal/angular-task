<?php
namespace App\Http\Services\Email;

use App\Http\Services\Email\EmailServiceProvider\Factory;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractEmail
{
    protected $formData;
    protected $params;
    protected $request;
    protected $mailStatus;
    protected $mailerServices = ['mailgun'];
    protected $apiResponse;
    protected $counter = 0;

    public function __construct()
    {
        $this->params = new ParameterBag();
    }

    public function send()
    {
        $this->process();
        if (!$this->isMailSendSuccessfully()) {
            $this->emailUsingAvailableServices();
        }
        $this->apiResponse = ['status' => 'success', 'message' => 'mail has been sent successfully'];
        return response($this->apiResponse);
    }

    public function process()
    {
        Mail::send($this->getTemplate(), ['data' => $this->params], function ($message) {
            $message->subject($this->getSubject());
            $message->from($this->getSender());
            $message->to($this->getReceiver());
        });
    }

    public function emailUsingAvailableServices()
    {

        foreach ($this->mailerServices as $service) {
            $mailerService = Factory::create($service);
            $mailerService->changeDriver();
            $this->process();
            if ($this->isMailSendSuccessfully()) {
                return;
            }
        }
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
