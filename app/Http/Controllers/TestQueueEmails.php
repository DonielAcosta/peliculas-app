<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestQueueEmails extends Controller
{
   /**
    * test email queues
    **/
    public function sendTestEmails()
    {
        $emailJobs = new TestSendEmail();
        $this->dispatch($emailJobs);


        Mail::to($request->user())
            ->queue(new TestMail());

             
    }
    
}
