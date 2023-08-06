<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $header;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Nên đưa vào queue các tác vụ liên quan đến xử lý lưu dữ liệu lưu vào database
        foreach($this->data as $sale) {
            // Lấy header làm key còn sale làm value
            $saleData = array_combine($this->header, $sale);
            Sales::create($saleData);
        }
    }

    public function failed(Throwable $exception) {

    }
}
