@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            @forelse($categories as $category)

                @continue(count($category->services) < 1)

                <div class="card b-radius--10 mb-4">
                    <div class="card-header"><h3>@lang($category->name)</h3></div>
                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light tabstyle--two">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Service ID')</th>
                                    <th scope="col">@lang('Service')</th>
                                    <th scope="col">@lang('Price Per 1k')</th>
                                    <th scope="col">@lang('Min')</th>
                                    <th scope="col">@lang('Max')</th>
                                    <th scope="col">@lang('Details')</th>
                                    <th scope="col">@lang('Make Order')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                    $services = $category->services()->active()->latest('id')->paginate(getPaginate(10), ['*'], slug($category->name))
                                @endphp

                                @forelse ($services as $item)
                                    <tr>
                                        <td data-label="@lang('Name')">{{__($item->id)}}</td>
                                        <td data-label="@lang('Category')" class="break_line">{{__($item->name)}}</td>
                                        <td data-label="@lang('Price Per 1k')">{{ $general->cur_sym . getAmount($item->price_per_k) }}</td>
                                        <td data-label="@lang('Min')">{{__($item->min)}}</td>
                                        <td data-label="@lang('Max')">{{__($item->max)}}</td>

                                        @if($item->details)
                                            <td data-label="@lang('Details')">
                                                <a href="javascript:void(0)" class="icon-btn btn--info detailsBtn"
                                                   data-original-title="@lang('Details')" data-toggle="tooltip" data-details="{{ $item->details }}">
                                                    <i class="la la-info"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif

                                        <td data-label="@lang('Action')">

                                            <a href="javascript:void(0)" class="icon-btn orderBtn"
                                               data-original-title="@lang('Edit')" data-toggle="tooltip"
                                               data-url="{{ route('user.order', [$category->id, $item->id])}}"
                                               data-price_per_k="{{ getAmount($item->price_per_k) }}"
                                               data-min="{{ $item->min }}" data-max="{{ $item->max }}">
                                                <i class="fa fa-cart-plus"></i>
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
                        {{ $services->withQueryString()->links('admin.partials.paginate') }}
                    </div>
                </div><!-- card end -->
            @empty
            @endforelse

        </div>
    </div>



    {{-- Details MODAL --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-share-square"></i> @lang('Details')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>

                    <div class="modal-body">

                        <div id="details">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    </div>
            </div>
        </div>
    </div>

    {{-- Order MODAL --}}
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-fw fa-share-square"></i>@lang('Place a new order')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row form-group">
                            <label for="link" class="font-weight-bold">@lang('Link') <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control has-error bold" id="link" name="link" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="quantity" class="font-weight-bold">@lang('Quantity') <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control has-error bold" id="quantity" name="quantity" required>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@lang('Min')</div>
                                    </div>
                                    <input type="text" name="min" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@lang('Max')</div>
                                    </div>
                                    <input type="text" name="max" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@lang('Price')</div>
                                    </div>
                                    <input type="text" class="form-control total_price text--success" name="price" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary" id="btn-save"
                                value="add">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .break_line{
            white-space: initial !important;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.detailsBtn').on('click', function () {
                var modal = $('#detailsModal');
                var details = $(this).data('details');

                modal.find('#details').html(details);
                modal.modal('show');
            });

            $('.orderBtn').on('click', function () {
                var modal = $('#orderModal');
                var url = $(this).data('url');
                var price_per_k = $(this).data('price_per_k');
                var min = $(this).data('min');
                var max = $(this).data('max');

                //Calculate total price
                $(document).on("keyup", "#quantity", function() {
                    var quantity = $('#quantity').val()
                    var total_price = (price_per_k/1000)*quantity;
                    modal.find('input[name=price]').val("{{ $general->cur_sym }}" + total_price.toFixed(2));
                });

                modal.find('form').attr('action', url);
                modal.find('input[name=quantity]').attr('min', min).attr('max', max);
                modal.find('input[name=min]').val(min);
                modal.find('input[name=max]').val(max);
                modal.modal('show');
            });

            //Scroll to paginate position
            var pathName = document.location.pathname;
            window.onbeforeunload = function () {
                var scrollPosition = $(document).scrollTop();
                sessionStorage.setItem("scrollPosition_" + pathName, scrollPosition.toString());
            }
            if (sessionStorage["scrollPosition_" + pathName]) {
                $(document).scrollTop(sessionStorage.getItem("scrollPosition_" + pathName));
            }
        })(jQuery);
    </script>
@endpush
