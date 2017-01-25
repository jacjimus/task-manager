<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
     * @param string
     * Destination email adress
     * 
     */
    public $address;
    /*
     * @param string
     * The name of the recepient
     */
    
    public $name;
    /*
     * @param string
     * The subject of the email
     */
    public $subject;
    
    
    public function build()
    {
        $this->address = $data->email;
        $this->name = $data->first_name . ' ' . $data->last_name;
        $this->subject = $data->subject;
        
        
        return $this->view('view.name')
                ->from($this->address, $this->name)
               // ->cc($address, $name)
                //->bcc($address, $name)
                //->replyTo($address, $name)
                ->subject($this->subject);;
    }
}
