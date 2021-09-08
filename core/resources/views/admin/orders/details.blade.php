@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">

            <div class="card b-radius--10 mb-4">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf

                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td data-label="@lang('Order ID')">@lang('Order ID')</td>
                                    <td class="text-left" data-label="@lang('Order ID')">{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('User')">@lang('User')</td>
                                    <td class="text-left" data-label="@lang('User')"><a href="{{ route('admin.users.detail', $order->user_id) }}">{{ $order->user->username }}</a></td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Category')">@lang('Category')</td>
                                    <td class="text-left" data-label="@lang('Category')">{{ $order->category->name }}</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Service')">@lang('Service')</td>
                                    <td class="text-left" data-label="@lang('Service')">{{ $order->service->name }}</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Link')">@lang('Link')</td>
                                    <td class="text-left" data-label="@lang('Link')"><a href="{{ empty(parse_url($order->link, PHP_URL_SCHEME)) ? 'https://' : null }}{{ $order->link }}" target="_blank">{{ $order->link }}</a></td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Quantity')">@lang('Quantity')</td>
                                    <td class="text-left" data-label="@lang('Quantity')">{{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Start Counter')">@lang('Start Counter')</td>
                                    <td data-label="@lang('Start Counter')" class="text-left">
                                        @if($order->status == 0 || $order->status == 1)
                                            <input type="text" name="start_counter" max="{{ $order->quantity }}" value="{{ $order->start_counter }}" class="form-control" required>
                                        @else
                                            {{ $order->start_counter }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="@lang('Remains')">@lang('Remains')</td>
                                    <td class="text-left" data-label="@lang('Remains')">{{ $order->remain }}</td>
                                </tr>

                                @if($order->api_order)
                                    <tr>
                                        <td data-label="@lang('API Order')">@lang('API Order')</td>
                                        <td class="text-left" data-label="@lang('API Order')">
                                            @if($order->api_order)
                                                <span class="text--small badge font-weight-normal badge--primary">@lang('Yes')</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($order->order_placed_to_api)
                                        <tr>
                                            <td data-label="@lang('API Order ID')">@lang('API Order ID')</td>
                                            <td class="text-left" data-label="@lang('API Order ID')"><strong>{{ @$order->api_order_id }}</strong></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td data-label="@lang('Order Placed')">@lang('Order Placed To API')</td>
                                        <td class="text-left" data-label="@lang('Order Placed')">
                                            @if($order->order_placed_to_api)
                                                <span class="text--small badge font-weight-normal badge--primary">@lang('Yes')</span>
                                            @else
                                                <span class="text--small badge font-weight-normal badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td data-label="@lang('Status')">@lang('Status')</td>
                                    <td data-label="@lang('Status')" class="text-left">
                                        @if($order->status === 0 || $order->status === 1)
                                            <select class="form-control" name="status" required>
                                                <option>--@lang('Select Status')--</option>
                                                <option value="0" {{ $order->status === 0 ? 'selected' : null }}>@lang('Pending')</option>
                                                <option value="1" {{ $order->status === 1 ? 'selected' : null }}>@lang('Processing')</option>
                                                <option value="2" {{ $order->status === 2 ? 'selected' : null }}>@lang('Completed')</option>
                                                <option value="3" {{ $order->status === 3 ? 'selected' : null }}>@lang('Cancelled')</option>
                                                <option value="4" {{ $order->status === 4 ? 'selected' : null }}>@lang('Refunded')</option>
                                            </select>
                                        @elseif($order->status === 2)
                                            <span
                                                class="text--small badge font-weight-normal badge--success">@lang('Completed')</span>
                                        @elseif($order->status === 3)
                                            <span
                                                class="text--small badge font-weight-normal badge--danger">@lang('Cancelled')</span>
                                        @else
                                            <span
                                                class="text--small badge font-weight-normal badge--dark">@lang('Refunded')</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($order->status === 0 || $order->status === 1)
                        <div class="card-footer">
                            <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                        </div>
                    @endif
                </form>
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text-white text--small" href="{{ url()->previous() }}"><i
            class="fa fa-fw fa-backward"></i>@lang('Go Back')</a>
@endpush
