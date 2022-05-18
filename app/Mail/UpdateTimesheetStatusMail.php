<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateTimesheetStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $timesheet_link;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($timesheet_link, $status)
    {
        $this->timesheet_link   = $timesheet_link;
        $this->status           = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Update on your Timesheet Submission")->view('emails.updateTimesheetSubmission');
    }
}
