<?php

namespace App\Modules\Booking\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Booking\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected BookingService $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bookable_type' => 'required|string|in:property,vehicle',
            'bookable_id' => 'required|integer',
            'start_date' => 'required|date',
            'total_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $booking = $this->service->createBooking($request->all());
            return response()->json($booking, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
