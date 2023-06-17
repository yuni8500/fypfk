<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\notificationMail;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class SendAppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appointment reminders one day before the appointment';

    /**
     * Execute the console command.
     *
    * @return int
    */
    public function handle(): void
{
    $tomorrow = Carbon::now('UTC')->addDay()->toDateString();

    $appointments = Appointment::where('appointDate', $tomorrow)
        ->where('statusAppoint', 'Approved')
        ->with(['user', 'supervisor']) // Include the 'supervisor' relationship
        ->get();

    foreach ($appointments as $appointment) {
        $data = [
            'startTime' => $appointment->startTime,
            'endTime' => $appointment->endTime,
            'appointLocation' => $appointment->appointLocation,
        ];

        Mail::to($appointment->user->email)->send(new notificationMail($data));
        Mail::to($appointment->supervisor->email)->send(new notificationMail($data)); // Send email to supervisor
    }

    $this->info('Appointment reminders sent successfully.');
}
}
