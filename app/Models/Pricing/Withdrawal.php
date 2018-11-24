<?php

namespace Models\Pricing;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Withdrawal extends Model {

    use BelongsToAUser,
        HasCurrency;

    protected $table = 'withdrawals';
    protected $guarded = ['id'];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    public function isPending() {
        return (int) $this->status === self::STATUS_PENDING;
    }

    public function getFormattedStatusAttribute() {
        return trans("frontend/payment.status.{$this->status}");
    }

}
