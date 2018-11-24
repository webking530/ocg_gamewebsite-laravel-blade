<?php

namespace Models\Pricing;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BankAccount;
use Models\Auth\BelongsToAUser;

class Deposit extends Model {

    use BelongsToAUser,
        HasCurrency;

    protected $guarded = ['id'];
    protected $dates = [
        'approved_at'
    ];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_REFUNDED = 3;
    const DCP_DISCOUNT_PERCENT = 10;

    public function bankAccount() {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }

    public function discountDeposit() {
        return $this->belongsTo(Deposit::class, 'discount_deposit_id');
    }

    public function scopeApproved($query) {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeRefunded($query) {
        return $query->where('status', self::STATUS_REFUNDED);
    }

    public function scopeNotRejected($query) {
        return $query->where('status', '!=', self::STATUS_REJECTED);
    }

    public function getFirstApprovedAttribute() {
        $firstApproved = self::where('status', Deposit::STATUS_APPROVED)
                ->whereNotNull('approved_at')
                ->orderBy('approved_at', 'ASC')
                ->first();

        return $this->id === $firstApproved->id;
    }

    public function hasDiscount() {
        return $this->discount_deposit_id != null;
    }

    public function discountUsed() {
        return self::where('discount_deposit_id', $this->id)->notRejected()->exists();
    }

    public function canBeUsedForDiscount() {
        if ($this->discountUsed()) {
            return false;
        }

        if (!$this->first_approved) {
            return false;
        }

        if ($this->user->first_refund) {
            return false;
        }

        return true;
    }

    public function getCalculatedDiscountAttribute() {
        return $this->amount * self::DCP_DISCOUNT_PERCENT / 100;
    }

    public function getCalculatedDiscountUsdAttribute() {
        return $this->amount_USD * self::DCP_DISCOUNT_PERCENT / 100;
    }

    public function getDiscountedPriceAttribute() {
        return $this->amount - $this->discount_amount;
    }

    public function getDiscountedUsdPriceAttribute() {
        return $this->amount_USD - $this->discount_amount_USD;
    }

    public function isPending() {
        return (int) $this->status === self::STATUS_PENDING;
    }

    public function getFormattedStatusAttribute() {
        return trans("frontend/payment.status.{$this->status}");
    }

}
