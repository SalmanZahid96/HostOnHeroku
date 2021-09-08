<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function process(Request $request)
    {
        $rules = [
            'action' => 'required|string|in:services,add,status',
            'key' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json($validator->errors()->getMessages());
        }

        //Checking api key exist
        if (!User::where('api_key', $request->key)->exists()){
            return response()->json(['error' => 'Invalid api key']);
        }

        //Checking the request action is services
        $action = $request->action;
        return $this->$action($request);

    }

    //List of services
    private function services($request)
    {
        $services = Service::active()->with('category')->get(['id', 'name', 'price_per_k as rate', 'min', 'max']);
        return response()->json($services);
    }

    //Place new order
    private function add($request)
    {
        //Service Validation
        $service_rules = [
            'service' => 'required|integer|gt:0'
        ];
        $validator = Validator::make($request->all(), $service_rules);
        if ($validator->fails()){
            return response()->json($validator->errors()->getMessages());
        }

        //Service
        $service = Service::find($request->service);
        if (!$service){
            return response()->json(['error' => 'Invalid Service Id']);
        }

        //Validation
        $rules = [
            'link' => 'required|string',
            'quantity' => 'required|integer|gte:'. $service->min . '|lte:' . $service->max,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors()->getMessages());
        }

        $price = getAmount(($service->price_per_k/1000) * $request->quantity);

        //Subtract user balance
        $user = User::where('api_key', $request->key)->firstOrFail();
        if ($user->balance < $price){
            return response()->json(['error' => 'Insufficient balance']);
        }
        $user->balance -= $price;
        $user->save();

        //Save order record
        $order = new Order();
        $order->user_id = $user->id;
        $order->category_id = $service->category_id;
        $order->service_id = $service->id;
        $order->link = $request->link;
        $order->quantity = $request->quantity;
        $order->price = $price;
        $order->remain = $request->quantity;
        $order->save();

        //Create Transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $price;
        $transaction->post_balance = getAmount($user->balance);
        $transaction->trx_type = '-';
        $transaction->details = 'Order for ' . $service->name;
        $transaction->trx = getTrx();
        $transaction->save();

        //Create admin notification
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New order request for ' . $service->name;
        $adminNotification->click_url = urlPath('admin.orders.details', $order->id);
        $adminNotification->save();

        //Send email to user
        $gnl = GeneralSetting::first();
        notify($user, 'PENDING_ORDER', [
            'service_name' => $service->name,
            'price' => $price,
            'currency' => $gnl->cur_text,
            'post_balance' => getAmount($user->balance)
        ]);

        return response()->json(['order' => $order->id]);
    }

    //Order Status
    private function status($request)
    {
        //Validation
        $rules = [
            'order' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors()->getMessages());
        }

        //Service
        $order = Order::where('id', $request->order)->select(['status', 'start_counter', 'remain'])->first();

        if (!$order){
            return response()->json(['error' => 'Invalid Order Id']);
        }

        $order['status'] = ($order->status == 0 ? 'pending' : ($order->status == 1 ? 'processing' : ($order->status == 2 ? 'completed' : ($order->status == 3 ? 'cancelled' : 'refunded'))));

        return response()->json($order);
    }

    /*
     * Web routes
     */

    // API Documentation
    public function api()
    {
        $page_title = 'API Documentation';
        return view(activeTemplate() . 'user.api.api', compact('page_title'));
    }

    public function generateNewKey()
    {
        $user = auth()->user();
        $user->api_key = sha1(time());
        $user->save();

        $notify[] = ['success', 'Generated new api key!'];
        return back()->withNotify($notify);
    }
}
