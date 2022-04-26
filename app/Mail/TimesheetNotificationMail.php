<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $timesheet_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($timesheet_link, $user_name)
    {
        $this->timesheet_link   = $timesheet_link;
        $this->user_name        = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Iprospect Timesheet Submission")->view('emails.timesheetSubmission');
    }
}
