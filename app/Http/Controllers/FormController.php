<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactForm;
use App\Http\Services\Email\Contact;

class FormController extends Controller
{
    public function index(ContactForm $request, Contact $email)
    {
        $email->setFormData($request->all());
        return $email->send();
    }
}
