<?php

namespace App\Service;

use App\Exceptions\ErrorResponse;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PlanService
{
    public function get(): Collection
    {
        // припустимо що підписок буде не багато і можно обійтися без фільтрів і пагінації
        return Plan::all();
    }

    public function create(array $data): Plan
    {
        return Plan::create($data);
    }

    /**
     * @throws ErrorResponse
     */
    public function update(int $id, array $data): Plan
    {
        $plan = Plan::find($id);

        if(!$plan) {
            throw new ErrorResponse('This plan does not exist');
        }

        $plan->update($data);

        // або Plan::where('id', $id)->update($data) якщо план повертати не треба

        return $plan->refresh();
    }

    /**
     * @throws ErrorResponse
     */
    public function delete(int $id): bool
    {
        $count = User::where('plan_id', $id)->count();

        if($count > 0) {
            throw new ErrorResponse("Users already use this plan");
        }

        return Plan::where('id', $id)->delete();
    }
}
