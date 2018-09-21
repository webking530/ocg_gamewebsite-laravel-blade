<?php

namespace App\Models\Pricing;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Deposit extends Model
{
    use BelongsToAUser;

    protected $guarded = ['id'];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;
}
