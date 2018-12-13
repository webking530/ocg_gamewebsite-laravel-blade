@inject('pricingService', "Models\Pricing\PricingService")

<h2 class="text-center">My Balance</h2>
<h3 class="text-center"><span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($user->credits, 2) }}</span> <span class="text-blue">&mdash;</span> @price($pricingService->exchangeCredits($user->credits, $user->currency_code), $user->currency_code)</h3>
<h3 class="text-center"><span class="money-earned-bonus"><i class="fas fa-star"></i> {{ number_format($user->credits_bonus, 2) }}</span></h3>