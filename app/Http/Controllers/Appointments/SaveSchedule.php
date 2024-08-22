<?php 

namespace App\Http\Controllers\Appointments;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Support\Facades\Validator;

class SaveSchedule extends Controller
{
    public function __invoke(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'frequency' => $request->input('frequency'),
            'start_date' => $request->input('start_date'),
            'days' => json_encode($request->input('days')),
            'time_of_day' => json_encode($request->input('time_of_day')),
            'notes' => $request->input('notes'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment' => $appointment,
        ], 201);
    }
}

