@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row mb-none-30">
        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="la la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $general->cur_sym . getAmount($widget['balance']) }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Balance')</span>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--green b-radius--10 box-shadow">
                <div class="icon">
                    <i class="la la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $general->cur_sym . getAmount($widget['total_spent']) }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Spent')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-7 b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="la la-exchange-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['total_transaction']}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Transaction')</span>
                    </div>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->


    <div class="row mt-50 mb-none-30">
        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.history') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="las la-shopping-cart overlay-icon text--primary"></i>
                    <div class="widget-two__icon b-radius--5 bg--primary">
                        <i class="las la-shopping-cart"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['total_order']}}</h2>
                        <p>@lang('Total Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.pending') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="las la-spinner overlay-icon text--warning"></i>
                    <div class="widget-two__icon b-radius--5 bg--warning">
                        <i class="las la-spinner"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['pending_order']}}</h2>
                        <p>@lang('Pending Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.processing') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="la la-refresh overlay-icon text--teal"></i>
                    <div class="widget-two__icon b-radius--5 bg--teal">
                        <i class="la la-refresh"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['processing_order']}}</h2>
                        <p>@lang('Processing Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>
    </div>

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.completed') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="las la-check-circle overlay-icon text--green"></i>
                    <div class="widget-two__icon b-radius--5 bg--green">
                        <i class="las la-check-circle"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['completed_order']}}</h2>
                        <p>@lang('Completed Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.cancelled') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="las la-times-circle overlay-icon text--pink"></i>
                    <div class="widget-two__icon b-radius--5 bg--pink">
                        <i class="la la-times-circle"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['cancelled_order']}}</h2>
                        <p>@lang('Cancelled Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-30">
            <a href="{{ route('user.order.refunded') }}">
                <div class="widget-two box--shadow2 b-radius--5 bg--white">
                    <i class="las la-fast-backward overlay-icon text--secondary"></i>
                    <div class="widget-two__icon b-radius--5 bg--secondary">
                        <i class="la la-fast-backward"></i>
                    </div>
                    <div class="widget-two__content">
                        <h2 class="">{{$widget['refunded_order']}}</h2>
                        <p>@lang('Refunded Order')</p>
                    </div>
                </div><!-- widget-two end -->
            </a>
        </div>
    </div>
@endsection
