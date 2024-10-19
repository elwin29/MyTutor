<?php

namespace App\Observers;

use App\Models\GroupParticipants;
use App\Models\ProductSubscription;
use App\Models\SubscriptionGroups;

class ProductSubscriptionObserver
{

    public function creating(ProductSubscription $subscription)
    {
        $subscription->booking_trx_id = $subscription->booking_trx_id ?? $this->generateUniqueTrxId();
    }

    private function generateUniqueTrxId(): string
    {
        $prefix = 'MyTutor';
        do {
            $randomString = $prefix . mt_rand(1000, 9999); // MyTutor1234
        } while (ProductSubscription::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function created(ProductSubscription $productSubscription): void
    {

    }

    public function updated(ProductSubscription $productSubscription): void
    {
        if ($productSubscription->isDirty('is_paid') && $productSubscription->is_paid) {
            $currentGroup = SubscriptionGroups::where('product_id', $productSubscription->product_id)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if (!$currentGroup || $currentGroup->participant_count >= $currentGroup->max_capacity) {
                $currentGroup = SubscriptionGroups::create([
                    'product_id' => $productSubscription->product_id,
                    'product_subscription_id' => $productSubscription->id,
                    'max_capacity' => $productSubscription->product->capacity,
                    'participant_count' => 0,
                ]);
            }

            $currentGroup->increment('participant_count');

            GroupParticipants::create([
                'name' => $productSubscription->name,
                'email' => $productSubscription->email,
                'subscription_group_id' => $currentGroup->id,
                'booking_trx_id' => $productSubscription->booking_trx_id,
            ]);
        }
    }

    public function deleted(ProductSubscription $productSubscription): void
    {

    }

    public function restored(ProductSubscription $productSubscription): void
    {

    }

    public function forceDeleted(ProductSubscription $productSubscription): void
    {

    }
}