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
    protected $spreadsheetId;
    protected $range;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows, string $spreadsheetId, string $range)
    {
        $this->rows = $rows;
        $this->spreadsheetId = $spreadsheetId;
        $this->range = $range;
    }

    /**
     * Execute the job.
     */
    public function handle(GoogleSheetsService $service): void
    {
        $maxPerRequest = 500;
        $batches = array_chunk($this->rows, $maxPerRequest);
        foreach ($batches as $batch) {
            $service->appendRows($this->spreadsheetId, $this->rows, $batch);
            sleep(5); // sleep for 1 sec to prevent API quota issues
        }
    }

    public function middleware()
    {
        return [new WithoutOverlapping()];
    }
}
