<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateSubscriptions extends Command
{
    protected $signature = 'subscription:update';

    protected $description = 'Cancellation user subscription after month';

    public function handle()
    {
        User::query()
            ->where('plan_activate_date', '<=', Carbon::now()->subMonth())
            ->update([
                'plan_id' => null,
                'plan_activate_date' => null
            ]);
    }
}
