<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogStudentCreation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
       public function handle(StudentCreated $event)
    {
        Log::info("New student added", [
            'name' => $event->student->name,
            'email' => $event->student->email,
            'created_at' => now(),
        ]);
    }
}
