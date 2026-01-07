<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class AssignRollNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:assign-roll-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Sequential roll numbers to students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students=Student::orderBy('created_at','asc')->get();

        $roll=1;

        foreach($students as $student){
             $student->roll_number = str_pad($roll, 3, '0', STR_PAD_LEFT);
            $student->save();
            $roll++;
        }
        $this->info('Roll number assigned successfully');
    }

}
