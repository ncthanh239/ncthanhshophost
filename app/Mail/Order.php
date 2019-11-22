<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Order extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id,$orderdetail)
    {
        $this->order_id = $order_id;
        $this->orderdetail=$orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ncthanh923@gmail.com')->view('emails.order', [
            'order_id' => $this->order_id,'orderdetail'=>$this->orderdetail
        ]);
    }
}
