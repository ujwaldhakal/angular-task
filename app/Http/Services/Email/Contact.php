<?php

namespace App\Http\Services\Email;

class Contact extends AbstractEmail
{
    protected $template = 'emails.contactform';
    protected $fillable = ['name','email','message'];
    protected $subject = 'contact form email';


}
