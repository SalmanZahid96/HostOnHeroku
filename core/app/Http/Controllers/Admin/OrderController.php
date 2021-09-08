<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function allOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: All orders";
            $orders = Order::where('user_id', $request->user)->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'All Orders';
            $orders = Order::with(['category', 'user'])->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    public function pendingOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: Pending orders";
            $orders = Order::where('user_id', $request->user)->pending()->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'Pending Orders';
            $orders = Order::with(['category', 'user'])->pending()->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    public function processingOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: Processing orders";
            $orders = Order::where('user_id', $request->user)->processing()->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'Processing Orders';
            $orders = Order::with(['category', 'user'])->processing()->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    public function completedOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: Completed orders";
            $orders = Order::where('user_id', $request->user)->completed()->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'Completed Orders';
            $orders = Order::with(['category', 'user'])->completed()->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    public function cancelledOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: Cancelled orders";
            $orders = Order::where('user_id', $request->user)->cancelled()->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'Cancelled Orders';
            $orders = Order::with(['category', 'user'])->cancelled()->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    public function refundedOrder(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title =  "{$user->username}: Refunded orders";
            $orders = Order::where('user_id', $request->user)->refunded()->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'Refunded Orders';
            $orders = Order::with(['category', 'user'])->refunded()->latest('id')->paginate(getPaginate());
        }

        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message'));
    }

    //Search
    public function search(Request $request)
    {
        if ($request->search){
            $search = $request->search;
            $page_title = "Search results for {{$search}}";

            $orders = Order::where('id', $search)->orWhereHas('user', function ($user) use ($search){
                $user->where('username', 'like', "%$search%");
            })->with(['category', 'user'])->latest('id')->paginate(getPaginate());
        } else {
            $page_title = 'All Orders';
            $search = '';
            $orders = Order::with(['category', 'user'])->latest('id')->paginate(getPaginate());
        }
        $empty_message = 'No Result Found';
        return view('admin.orders.index', compact('page_title', 'orders', 'empty_message', 'search'));
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);

        $page_title = 'Order Details';
        return view('admin.orders.details', compact('page_title', 'order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'start_counter' => 'required|integer|gte:0|lte:' . $order->quantity,
            'status' => 'required|integer|in:0,1,2,3,4'
        ]);

        $order->start_counter = $request->start_counter;
        $order->remain = ($order->quantity - $request->start_counter);

        $user = User::findOrFail($order->user_id);

        //Processing
        if ($request->status == 1){
            $order->status = 1;
            $order->save();

            //Send email to user
            notify($user, 'PROCESSING_ORDER', [
                'service_name' => $order->service->name
            ]);
        }

        //Completed
        if ($request->status == 2){
            $order->status = 2;
            $order->save();

            //Send email to user
            notify($user, 'COMPLETED_ORDER', [
                'service_name' => $order->service->name
            ]);
        }

        //Cancelled
        if ($request->status == 3){
            $order->status = 3;
            $order->save();

            //Send email to user
            notify($user, 'CANCELLED_ORDER', [
                'service_name' => $order->service->name
            ]);
        }

        //Refunded
        if ($request->status == 4){
            $order->status = 4;
            $order->save();

            //Refund balance
            $user->balance += $order->price;
            $user->save();

            //Create Transaction
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = getAmount($order->price);
            $transaction->post_balance = getAmount($user->balance);
            $transaction->trx_type = '+';
            $transaction->details = 'Refund for Order ' . $order->service->name;
            $transaction->trx = getTrx();
            $transaction->save();

            //Send email to user
            $gnl = GeneralSetting::first();
            notify($user, 'REFUNDED_ORDER', [
                'service_name' => $order->service->name,
                'price' => getAmount($order->price),
                'currency' => $gnl->cur_text,
                'post_balance' => getAmount($user->balance),
                'trx' => $transaction->trx
            ]);
        }

        $order->save();
        $notify[] = ['success', 'Successfully updated!'];
        return back()->withNotify($notify);
    }
}
