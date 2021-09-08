<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ServiceController extends Controller
{
    public function index()
    {
        $page_title = 'Services';
        $empty_message = 'No Result Found';
        $categories = Category::active()->orderBy('name')->get();
        $services = Service::with('category')->latest()->paginate(getPaginate());
        return view('admin.services.index', compact('page_title', 'services', 'empty_message', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer',
            'name' => 'required|string|max:191',
            'price_per_k' => 'required|numeric|gt:0',
            'min' => 'required|integer|gt:0|lt:'. $request->max,
            'max' => 'required|integer|gt:'. $request->min,
            'details' => 'required|string',
            'api_service_id' => 'nullable|integer|gt:0|unique:services,api_service_id'
        ]);

        $service = new Service();
        $this->serviceAction($service,$request);
        $service->save();

        $notify[] = ['success', 'Service added!'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|integer',
            'name' => 'required|string|max:191',
            'price_per_k' => 'required|numeric|gt:0',
            'min' => 'required|integer|gt:0|lt:'. $request->max,
            'max' => 'required|integer|gt:'. $request->min,
            'details' => 'required|string',
            'api_service_id' => 'nullable|integer|gt:0|unique:services,api_service_id,' . $id
        ]);

        $service = Service::findOrFail($id);
        $this->serviceAction($service,$request);
        $service->save();

        $notify[] = ['success', 'Service updated!'];
        return back()->withNotify($notify);
    }

    private function serviceAction($service,$request){
        $service->category_id = $request->category;
        $service->name = $request->name;
        $service->price_per_k = $request->price_per_k;
        $service->min = $request->min;
        $service->max = $request->max;
        $service->details = $request->details;
        $service->api_service_id = $request->api_service_id;
    }

    public function status($id)
    {
        $service = Service::findOrFail($id);
        $service->status = ($service->status ? 0 : 1);
        $service->save();

        $notify[] = ['success', 'Status updated!'];
        return back()->withNotify($notify);
    }

    //Api services
    public function apiServices()
    {
        $page_title = 'API Services';
        $empty_message = 'No Result Found';
        $categories = Category::active()->orderBy('name')->get();

        $general = GeneralSetting::first();

        $url = $general->api_url;
        $arr = [
            'key' => $general->api_key,
            'action' => "services",
        ];
        $response = json_decode(curlPostContent($general->api_url,$arr));

        if (@$response->error){
            $notify[] = ['info', 'Please enter your api credentials from API Setting Option'];
            $notify[] = ['error', $response->error];
            return back()->withNotify($notify);
        }

        $response = collect($response);

        $services = $this->paginate($response, getPaginate(), null, ['path' => route('admin.services.apiServices')]);

        return view('admin.services.apiServices', compact('page_title', 'services', 'empty_message', 'categories'));
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
