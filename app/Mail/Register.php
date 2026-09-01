<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user_name;
    public $email;
    public $password;
    public $role;
    

    public function __construct($user_name, $email, $password, $role)
    {
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role ? $role : 0;

        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['user_name'] = $this->user_name;
        $user['email'] = $this->email;
        $user['password'] = $this->password;
        $user['role'] = $this->role;
        

        return $this->from(config('mail.from.address'), config('mail.from.name'))
        ->subject('Account Created With Makka Construction')
        ->view('template.registeration', ['user' => $user]);
    }
}
