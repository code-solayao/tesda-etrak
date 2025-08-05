<?php

namespace App\Jobs;

use App\Services\GoogleSheetsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class ExportChunkToSheets implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;
    protected $rows;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     */
    public function handle(GoogleSheetsService $service): void
    {
        $service->appendRows('List of Graduates', $this->rows);
    }

    public function middleware()
    {
        return [new WithoutOverlapping()];
    }
}
