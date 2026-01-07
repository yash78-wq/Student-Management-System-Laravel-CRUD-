<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class SendStudentCreatedNotification implements ShouldQueue
{
    use Queueable,Dispatchable,SerializesModels;

    public $student;
    /**
     * Create a new job instance.
     */
    public function __construct($student)
    {
        $this->student= $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->student) {
            Log::info("Student no longer exists.");
            return;
        }
        Log::info("New student: " . $this->student->name);
 }
}
