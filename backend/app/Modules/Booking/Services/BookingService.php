<?php

namespace App\Modules\Booking\Services;

use App\Models\Booking;
use App\Models\Property;
use App\Models\Vehicle;
use App\Modules\Core\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

class BookingService extends BaseService
{
    public function createBooking(array $data)
    {
        return DB::transaction(function () use ($data) {
            $bookable = $this->resolveBookable($data['bookable_type'], $data['bookable_id']);

            if ($bookable->status !== 'available') {
                throw new Exception('Item is not available for booking');
            }

            $booking = Booking::create([
                'user_id' => auth('api')->id(),
                'bookable_type' => $data['bookable_type'],
                'bookable_id' => $data['bookable_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'total_price' => $data['total_price'],
                'status' => 'pending',
            ]);

            // Update status to booked (if applicable for vehicles)
            if ($bookable instanceof Vehicle) {
                $bookable->update(['status' => 'booked']);
            }

            return $booking;
        });
    }

    protected function resolveBookable(string $type, $id)
    {
        if ($type === 'property') {
            return Property::findOrFail($id);
        } elseif ($type === 'vehicle') {
            return Vehicle::findOrFail($id);
        }
        throw new Exception('Invalid bookable type');
    }
}
