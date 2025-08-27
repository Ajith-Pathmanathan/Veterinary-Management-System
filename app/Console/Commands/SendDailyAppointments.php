<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Appointment;
use App\Mail\DailyAppointmentsMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyAppointments extends Command
{
    protected $signature = 'email:daily-appointments';
    protected $description = 'Send daily appointments to doctors';

    public function handle()
    {
        $doctors = User::where('role_id', 3)->get(); // adjust doctor role_id if needed

        foreach ($doctors as $doctor) {
            $appointments = Appointment::with('pet')
                ->where('doctor_id', $doctor->id)
                ->where('date', Carbon::today()->toDateString())
                ->get();

            Mail::to($doctor->email)->send(new DailyAppointmentsMail($doctor, $appointments));
        }

        $this->info('Daily appointment emails sent to all doctors.');
    }
}
//php artisan schedule:run
//* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
