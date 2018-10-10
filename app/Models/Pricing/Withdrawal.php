<?php

namespace Models\Pricing;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Withdrawal extends Model
{
    use BelongsToAUser;

    protected $table = 'withdrawals';
    protected $guarded = ['id'];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
}
