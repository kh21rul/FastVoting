<?php

namespace App\Mail;

use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotingInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The voter instance.
     *
     * @var \App\Models\Voter
     */
    public $voter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Voter $voter)
    {
        $this->voter = $voter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.voting-invitation')
            ->subject('Voting Invitation');
    }
}
