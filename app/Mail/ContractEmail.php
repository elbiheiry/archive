<?php

namespace App\Mail;

use App\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContractEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $contract;

    public function __construct(Contract $contract)
    {
        //
        $this->contract = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.index')
            ->with([
                'name' => $this->contract->name,
                'register_date' => $this->contract->register_date
            ])
            ->subject('تنبيه انتهاء العقد')
            ->from('info@mohamed-elbiheiry.com' , 'انتهاء العقد');
    }
}
