<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionTest extends TestCase
{
    #[Test]
    public function it_returns_true_when_subscription_is_active(): void
    {
        $subscription = new Subscription([
            'starts_at' => Carbon::now()->subDays(5),
            'ends_at' => Carbon::now()->addDays(5),
            'canceled_at' => null,
        ]);

        $this->assertTrue($subscription->isActive());
    }

    #[Test]
    public function it_returns_false_when_subscription_is_cancelled(): void
    {
        $subscription = new Subscription([
            'starts_at' => Carbon::now()->subDays(5),
            'ends_at' => Carbon::now()->addDays(5),
            'canceled_at' => Carbon::now(),
        ]);

        $this->assertFalse($subscription->isActive());
    }

    #[Test]
    public function it_returns_false_when_subscription_has_not_started_yet(): void
    {
        $subscription = new Subscription([
            'starts_at' => Carbon::now()->addDays(2),
            'ends_at' => Carbon::now()->addDays(10),
            'canceled_at' => null,
        ]);

        $this->assertFalse($subscription->isActive());
    }

    #[Test]
    public function it_returns_false_when_subscription_has_ended(): void
    {
        $subscription = new Subscription([
            'starts_at' => Carbon::now()->subDays(10),
            'ends_at' => Carbon::now()->subDays(1),
            'canceled_at' => null,
        ]);

        $this->assertFalse($subscription->isActive());
    }
}
