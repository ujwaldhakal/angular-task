<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\Email\Contact;

class FormController extends Controller
{
    public function index(Contact $email)
    {
        $email->setFormData();
        $email->send();
    }
}
