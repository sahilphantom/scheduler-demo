<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    protected $fillable = [
        'starts_at',
        'ends_at',
        'canceled_at',
    ];

    protected $dates = ['starts_at', 'ends_at', 'canceled_at'];

    /**
     * Determine if the subscription is currently active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        $now = Carbon::now();

        return is_null($this->canceled_at)
            && $this->starts_at <= $now
            && $now <= $this->ends_at;
    }
}
