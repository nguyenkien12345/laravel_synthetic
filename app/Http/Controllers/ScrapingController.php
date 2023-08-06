<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{
    public function index(Request $request){
        // Demo link url này: http://nguyenphuc.com.vn/laptop-tablet-mobile
        $results = [];

        $url = $request->get('url');

        $client = new HttpBrowser(HttpClient::create());
        // Gửi 1 yêu cầu http GET đến địa chỉ được chỉ định
        $response = $client->request('GET', $url);

        $nodes =  $response->filter('.list-item-product #js_product_list__item .product-item');

        // use (&$results) là một cú pháp trong PHP được sử dụng khi bạn muốn truy cập và thay đổi giá trị của biến bên ngoài
        // từ bên trong một hàm closure.

        if(count($nodes) > 0) {
            $nodes->each(function($item) use (&$results){
                $descriptions = [];
                $promotions = [];
                $title    = $item->filter('.title .head h4')->count() ? $item->filter('.title .head h4')->text() : '';
                $oldPrice = $item->filter('.title .info .item-pr-price .product-item-price-old')->count() ? $item->filter('.title .info .item-pr-price .product-item-price-old')->text() : '';
                $newPrice = $item->filter('.title .info .item-pr-price .product-item-price')->count() ? $item->filter('.title .info .item-pr-price .product-item-price')->text() : '';
                $image    = $item->filter('.product .img picture img')->count() ? $item->filter('.product .img picture img')->attr('src') : '';
                $item->filter('.title .info .text ul li')->count() > 0 && $item->filter('.title .info .text ul li')->each(function($x) use (&$descriptions){
                    $descriptions[] = $x->text();
                });
                $item->filter('.title .info .pre-box-sale__content ul li')->count() > 0 && $item->filter('.title .info .pre-box-sale__content ul li')->each(function($x) use (&$promotions){
                    $promotions[] = $x->text();
                });
                $results[$title] = [
                    'old-price' => $oldPrice,
                    'new-price' => $newPrice,
                    'image' => $image,
                    'description' => $descriptions,
                    'promotion' => $promotions
                ];
            });
        }

        return response()->json([
            '$results' => $results,
        ]);
    }
}
