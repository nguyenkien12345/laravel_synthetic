<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class UploadMillionRecordController extends Controller
{
    public function index(){
        return view('upload-million-record.index');
    }

    public function uploadMillionRecord(Request $request){
        if($request->has('filecsv')) {
            // Bước 1: Đọc toàn bộ nội dung của file csv
            $data =  file($request->filecsv);

            // Bước 2: chunking file
            // Giả sử ta có 1 file có 50.000 record thì lúc này ta sẽ chia file lớn này ra làm 50 file nhỏ (50 chunk). Mỗi chunk sẽ
            // có 1000 record
            $chunks = array_chunk($data, 1000);

            $header = [];

            // Sử dụng job batching
            $batch = Bus::batch([])->dispatch();

            foreach($chunks as $key => $chunk){
                // Key ở đây chính là từ 0 đến 49
                // file: đọc nội dung của tệp csv, str_getcsv: chuyển từng dòng trong tệp csv thành mảng
                $data = array_map('str_getcsv', $chunk);
                if($key === 0) {
                    $header = $data[0];
                    // Sau khi đã lấy được tiêu đề ra thì ta sẽ loại bỏ dòng tiêu đề này ra khỏi mảng $data;
                    unset($data[0]);
                }

                // Không sử dụng job batching
                // Gọi đến hàm handle của app/Jobs/SalesCsvProcess (Các tham số này sẽ được nhận thông qua constructor) (Xử lý queue)
                // SalesCsvProcess::dispatch($data, $header);

                // Sử dụng job batching
                $batch->add(new SalesCsvProcess($data, $header));
            }

            // Ban đầu khi trả ra ta sẽ thấy nó luôn luôn có
            // "totalJobs": 0,
            // "pendingJobs": 0,
            // "processedJobs": 0,
            // "progress": 0,
            // "failedJobs": 0,
            // "finishedAt": null
            // Lúc này ta sẽ viết 1 hàm tìm theo id của batch và truyền id vào hàm đó để kiểm tra tiến độ của batch này
            return $batch;
        }
    }

    // Kiểm tra tiến độ của batch này
    public function watchBatch(Request $request){
        $batchId = $request->id;
        return Bus::findBatch($batchId);
    }
}
