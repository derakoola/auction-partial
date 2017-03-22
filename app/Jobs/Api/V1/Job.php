<?php

namespace App\Jobs\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Job implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
}
