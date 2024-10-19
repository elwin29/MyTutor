<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Product;
use App\Models\ProductSubscription;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookingController extends Controller
{
    //
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    
    public function booking(Product $product)
    {
        $tax = 0.11;
        $totalTaxAmount = $tax * $product->price_per_person;
        $grandTotalAmount = $product->price_per_person + $totalTaxAmount;

        return view('booking.booking', compact('product', 'totalTaxAmount', 'grandTotalAmount'));
    }

    public function bookingStore(Product $product, StoreBookingRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->bookingService->storeBookingInSession($product, $validated);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to store booking. Please try again.']);
        }

        return redirect()->route('front.payment');
    }

    public function payment()
    {
        $data = $this->bookingService->payment();
        return view('booking.payment', $data);
    }

    public function paymentStore(StorePaymentRequest $request) {
        $validated = $request->validated();

    try {
        // Store booking transaction and get its ID
        $bookingTransactionId = $this->bookingService->paymentStore($validated);

        if ($bookingTransactionId) {
            Log::info('Redirecting to booking finished with ID: ' . $bookingTransactionId);
            
            // Ensure parameter matches route
            return redirect()->route('front.booking_finished', ['productSubscription' => $bookingTransactionId]);
        }

        Log::error('Payment failed: Booking Transaction ID not generated.');
        return redirect()->route('front.payment')->withErrors(['error' => 'Payment failed. Try again.']);

    } catch (\Exception $e) {
        Log::error('Payment error: ' . $e->getMessage());
        return redirect()->route('front.payment')->withErrors(['error' => 'Unexpected error occurred.']);
    }
    }

    public function bookingFinished(ProductSubscription $productSubscription) {
        return view('booking.booking_finished', compact('productSubscription'));
    }

    public function checkBooking(){
        return view('booking.check_booking');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();

        $bookingData = $this->bookingService->getBookingDetailsWithGroupAndCapacity($validated);

        if ($bookingData) {
            return view('booking.check_booking_details', $bookingData);
        }

        return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaction not found.']);
    }
}
