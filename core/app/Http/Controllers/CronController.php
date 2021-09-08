<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class CronController extends Controller
{
    public function placeOrderToApi()
    {
        $apiOrders = Order::apiorder()->ordernotplaced()->get();
        $general = GeneralSetting::first();
        $general->last_cron = now();
        $general->save();


        foreach ($apiOrders as $order) {
            $response = Http::post($general->api_url, [
                'key' => $general->api_key,
                'action' => "add",
                'service' => $order->api_service_id,
                'link' => $order->link,
                'quantity' => $order->quantity,
            ]);

            if (array_key_exists('error', $response->json())){
                return response()->json(['error' => $response->json()['error']]);
            }

            //Order placed
            $order->order_placed_to_api = 1;
            $order->api_order_id = $response->json()['order'];
            $order->save();
        }

    }
}
