<?php 

namespace App\Http\Controllers\Appointments;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SaveSchedule extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'frequency' => 'required|string|in:recurring,one-time',
                        'start_date' => 'required|date|after_or_equal:today',
                        'days' => 'required|array',
                        'days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                        'time_of_day' => 'required|array',
                        'time_of_day.*' => 'in:morning,afternoon,evening',
                        'notes' => 'nullable|string',
                    ], [
                        'frequency.required' => 'The frequency field is required.',
                        'start_date.required' => 'The start date field is required.',
                        'days.required' => 'Please select at least one day.',
                        'days.array' => 'The days field must be an array.',
                        'days.*.in' => 'One or more selected days are invalid. Please choose from Monday to Sunday.',
                        'time_of_day.required' => 'Please select at least one time of day.',
                        'time_of_day.array' => 'The time of day field must be an array.',
                        'time_of_day.*.in' => 'One or more selected times of day are invalid. Please choose from morning, afternoon, or evening.',
                        'notes.string' => 'The notes field must be a string.',
                    ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

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

