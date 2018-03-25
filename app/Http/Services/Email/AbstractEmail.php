<?php
namespace Services\Email;

use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractEmail
{
    protected $formData;
    protected $parameterBag;

    public function __construct()
    {
        $this->parameterBag = new ParameterBag();
    }

    public function send()
    {

    }

    public function setFormData(array $data)
    {
//        foreach($data as $key => $value) {
//            $this->parameterBag{}
//        }
    }

}
