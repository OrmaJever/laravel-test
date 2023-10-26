<?php

namespace App\Http\Controllers;

use App\Http\Requests\Plan\CreatePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;
use App\Http\Resources\PlanResource;
use App\Service\PlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function get(PlanService $planService)
    {
        $plans = $planService->get();

        return PlanResource::collection($plans);
    }

    public function create(CreatePlanRequest $request, PlanService $planService)
    {
        $validated = $request->validated();

        $plan = $planService->create($validated);

        return new PlanResource($plan);
    }

    public function update(int $id, UpdatePlanRequest $request, PlanService $planService)
    {
        $validated = $request->validated();

        $plan = $planService->update($id, $validated);

        return new PlanResource($plan);
    }

    public function delete(int $id, PlanService $planService)
    {
        $result = $planService->delete($id);

        return response()->json([
            'status' => $result ? 'success' : 'error'
        ]);
    }
}
