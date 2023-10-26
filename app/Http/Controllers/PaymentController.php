<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PaymentIpnRequest;
use App\Service\PaymentService;
use Illuminate\Support\Facades\Auth;


// це видуманий функціонал оплати, всі назви видумані всі співпадіння випадкові :)
class PaymentController extends Controller
{
    public function payment(int $plan_id, PaymentService $paymentService)
    {
        $url = $paymentService->payment($plan_id, Auth::user());

        return response()->json([
            'status' => 'success',
            'url' => $url
        ]);
    }

    public function ipn(PaymentIpnRequest $request, PaymentService $paymentService)
    {
        $validated = $request->validated();

        if($validated['signature'] != 'payment_signature') {
            return response()->json([
                'status' => 'error'
            ]);
        }

        $result = $paymentService->payment_proccess($validated['payload']['user_id'], $validated['payload']['plan_id']);

        return response()->json([
            'status' => $result ? 'success' : 'error'
        ]);
    }
}
