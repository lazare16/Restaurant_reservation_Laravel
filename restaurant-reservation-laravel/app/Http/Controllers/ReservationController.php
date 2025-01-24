<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::with(['user', 'menus'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_number' => [
                'required',
                'integer',
                'exists:tables,table_number',
                function ($attribute, $value, $fail) use ($request) {
                    $doubleBooking = Reservation::where('table_number', $value)
                        ->where('reservation_date', $request->reservation_date)
                        ->where('reservation_time', $request->reservation_time)
                        ->exists();
    
                    if ($doubleBooking) {
                        $fail('The selected table is already reserved for the given date and time.');
                    }
                },
            ],
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);
    
        $reservation = Reservation::create($data);
        return response()->json($reservation, 201);
    }

    public function show(Reservation $reservation)
    {
        return $reservation->load(['user', 'menus']);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'table_number' => 'integer',
            'reservation_date' => 'date',
            'reservation_time' => 'string',
            'number_of_guests' => 'integer',
            'special_request' => 'nullable|string',
            'status' => 'in:pending,confirmed,canceled',
        ]);

        $reservation->update($data);
        return response()->json($reservation, 200);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
}
