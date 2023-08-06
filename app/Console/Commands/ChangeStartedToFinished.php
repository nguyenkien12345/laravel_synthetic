<?php

namespace App\Console\Commands;

use App\Enums\PollStatus;
use App\Models\Poll;
use Illuminate\Console\Command;

class ChangeStartedToFinished extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poll:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change poll form start to finish';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Nếu poll đang ở trạng thái STARTED và hết hạn cho phép thì chuyển status từ STARTED sang FINISHED
        $startedPoll = Poll::query()->where([
            ['start_at', '<', now()],
            ['end_at', '<', now()],
            ['status', PollStatus::STARTED->value],
        ])->update(['status' => PollStatus::FINISHED->value]);
        return Command::SUCCESS;
    }
}
