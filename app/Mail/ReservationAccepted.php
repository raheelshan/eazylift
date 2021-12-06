<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationAccepted extends Mailable
{
    use Queueable, SerializesModels;


    // public $order; public property can be accessed inside view without passing
    // protected $order; protected property can not be accessed inside view without passing

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /*
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    */

    // php artisan make:mail OrderShipped
        
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                    ->from('example@example.com')
                    ->view('view.name');
                    // passing data
                    //->with(['orderName' => $this->order->name,'orderPrice' => $this->order->price]);
                    // attachment
                    // ->attach('/path/to/file')
                    // ->attach('/path/to/file', ['as' => 'name.pdf','mime' => 'application/pdf']);
                    // From disk
                    // ->attachFromStorage('/path/to/file')
                    // ->attachFromStorage('/path/to/file', 'name.pdf', ['mime' => 'application/pdf']);
                    // ->attachFromStorageDisk('s3', '/path/to/file')
                    // Raw
                    // ->attachData($this->pdf, 'name.pdf', ['mime' => 'application/pdf']);


        // plain text email
        // return $this->view('emails.orders.shipped')->text('emails.orders.shipped_plain');
    }
}

/*
// Send mail

    $order = Order::findOrFail($request->order_id);

    // Ship the order...

    Mail::to($request->user())->send(new OrderShipped($order));

    Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->send(new OrderShipped($order));

    foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
        Mail::to($recipient)->send(new OrderShipped($order));
    }



    //Queing 
        Mail::to($request->user())
        ->cc($moreUsers)
        ->bcc($evenMoreUsers)
        ->queue(new OrderShipped($order));

    // delaying in queue
    Mail::to($request->user())
    ->cc($moreUsers)
    ->bcc($evenMoreUsers)
    ->later(now()->addMinutes(10), new OrderShipped($order));

    // Always Queue
    use Illuminate\Contracts\Queue\ShouldQueue;

    class OrderShipped extends Mailable implements ShouldQueue
    {
        // avoid errors
        public $afterCommit = true;

    }
    // send will automatically queue it

    //render view as string
    return (new InvoicePaid($invoice))->render();

    // preview in the browser
    Route::get('/mailable', function () {
        $invoice = App\Models\Invoice::find(1);

        return new App\Mail\InvoicePaid($invoice);
    });  
    
    // localize
    Mail::to($request->user())->locale('es')->send(new OrderShipped($order));

    // User Preferred Locales
    use Illuminate\Contracts\Translation\HasLocalePreference;

    class User extends Model implements HasLocalePreference
    {
        public function preferredLocale()
        {
            return $this->locale;
        }
    }

    // Events
    class EventServiceProvider extends ServiceProvider
    {
        protected $listen = [
            'Illuminate\Mail\Events\MessageSending' => [
                'App\Listeners\LogSendingMessage',
            ],
            'Illuminate\Mail\Events\MessageSent' => [
                'App\Listeners\LogSentMessage',
            ],
        ];
    }    

*/