<?php

namespace App\Service;

use App\Exceptions\ErrorResponse;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

// це видуманий функціонал оплати, всі назви видумані всі співпадіння випадкові :)
class PaymentService
{
    /**
     * @throws ErrorResponse
     */
    public function payment(int $planId, User $user): string
    {
        if($user->plan_id) {
            throw new ErrorResponse("You already have plan");
        }

        $plan = Plan::find($planId);

        if(!$plan) {
            throw new ErrorResponse("This plan does not exist");
        }

        $payload = json_encode(['user_id' => $user->id, 'plan_id' => $plan->id]);

        return sprintf('https://liqpay/payment?price=%f&payload=%s', $plan->price, urlencode($payload));
    }

    public function payment_proccess(int $userId, int $planId): bool
    {
        $user = User::find($userId);

        if(!$user) {
            Log::warning("payment_error", ["User does not exists", $userId]);
            return false;
        }

        $plan = Plan::find($planId);

        if(!$plan) {
            Log::warning("payment_error", ["Plan does not exists", $planId]);
            return false;
        }

        $user->plan_id = $planId;
        $user->plan_activate_date = Carbon::now();
        $user->save();

        return true;
    }
}
