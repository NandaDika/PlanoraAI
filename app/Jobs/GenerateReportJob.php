<?php
namespace App\Jobs;

use App\Models\DataRPP;
use App\Services\GeminiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use function Illuminate\Log\log;

class GenerateReportJob implements ShouldQueue
{

    use Dispatchable, Queueable;
    public function __construct(public $reportId) {}

    public function handle(GeminiService $gemini)
    {
        $report = DataRPP::find($this->reportId);

        if (!$report) return;

        $report->update(['status' => 'processing']);

        try {
            $result = $gemini->generate(
                json_decode($report->input_data, true),
                $report->core_type
            );

            $report->update([
                'hasil_ai' => json_encode($result),
                'status' => 'done'
            ]);

        } catch (\Throwable $e) {
            try {
                $report->update([
                    'status' => 'failed',
                    'hasil_ai' => substr($e->getMessage(), 0, 1000) // batasi
                ]);
            } catch (\Throwable $e2) {
                //Log::error('FAILED SAVE ERROR: ' . $e2->getMessage());
            }
            //Log::error('MAIN ERROR: ' . $e->getMessage());
        }
    }
}
