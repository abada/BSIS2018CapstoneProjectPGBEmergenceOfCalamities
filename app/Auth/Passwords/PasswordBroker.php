<?php
namespace App\Auth\Passwords;

use Illuminate\Auth\Passwords\PasswordBroker as IlluminatePasswordBroker;

class PasswordBroker extends IlluminatePasswordBroker
{

    public function emailResetLink()
    {
        $view = $this->emailView;

        return $this->mailer->queue($view, compact('token', 'user'), function ($m) use ($user, $token, $callback) {
            $m->to($user->getEmailForPasswordReset());
            if (! is_null($callback)) {
                call_user_func($callback, $m, $user, $token);
            }
        });
    }

}