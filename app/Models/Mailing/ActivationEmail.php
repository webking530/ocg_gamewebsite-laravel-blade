<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 09/11/18
 * Time: 11:53 AM
 */

namespace Models\Mailing;


class ActivationEmail extends BaseEmail
{
    public function view()
    {
        return 'email.auth.activation_email';
    }

    public function subject()
    {
        return trans('emails.activation.subject');
    }
}