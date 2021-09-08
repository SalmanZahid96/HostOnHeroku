@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">

            <div class="card b-radius--10 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light tabstyle--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Order ID')</th>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Service')</th>
                                <th scope="col">@lang('Quantity')</th>
                                <th scope="col">@lang('Start Counter')</th>
                                <th scope="col">@lang('Remains')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('API Order')</th>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td data-label="@lang('Order ID')">{{ $item->id }}</td>
                                    <td data-label="@lang('User')"><a
                                            href="{{ route('admin.users.detail', $item->user_id) }}">{{ $item->user->username }}</a></td>
                                    <td data-label="@lang('Category')">{{__($item->category->name)}}</td>
                                    <td data-label="@lang('Service')">{{ __($item->service->name) }}</td>
                                    <td data-label="@lang('Quantity')">{{ $item->quantity }}</td>
                                    <td data-label="@lang('Start Counter')">{{ $item->start_counter }}</td>
                                    <td data-label="@lang('Remains')">{{ $item->remain }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status === 0)
                                            <span
                                                class="text--small badge font-weight-normal badge--warning">@lang('Pending')</span>
                                        @elseif($item->status === 1)
                                            <span
                                                class="text--small badge font-weight-normal badge--primary">@lang('Processing')</span>
                                        @elseif($item->status === 2)
                                            <span
                                                class="text--small badge font-weight-normal badge--success">@lang('Completed')</span>
                                        @elseif($item->status === 3)
                                            <span
                                                class="text--small badge font-weight-normal badge--danger">@lang('Cancelled')</span>
                                        @else
                                            <span
                                                class="text--small badge font-weight-normal badge--dark">@lang('Refunded')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('API Order')">
                                        @if($item->api_order)
                                            <span
                                                class="text--small badge font-weight-normal badge--primary">@lang('Api')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Date')">{{ showDateTime($item->created_at) }}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.orders.details', $item->id) }}" class="icon-btn btn--primary ml-1">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                <div class="card-footer">
                    {{ $orders->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="{{ route('admin.orders.search') }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or Order ID')" value="{{ $search ?? '' }}" required>
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush


@push('style')
    <style>
        .break_line{
            white-space: initial !important;
        }
    </style>
@endpush

