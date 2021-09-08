@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light tabstyle--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('ID')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Rate')</th>
                                <th scope="col">@lang('Min')</th>
                                <th scope="col">@lang('Max')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($services as $item)
                                <tr>
                                    <td data-label="@lang('ID')"><strong>{{__(@$item->service)}}</strong></td>
                                    <td data-label="@lang('Name')" class="break_line">{{__(@$item->name)}}</td>
                                    <td data-label="@lang('Category')" class="break_line">{{__(@$item->category)}}</td>
                                    <td data-label="@lang('Rate')">{{ $general->cur_sym . getAmount(@$item->rate) }}</td>
                                    <td data-label="@lang('Min')">{{__(@$item->min)}}</td>
                                    <td data-label="@lang('Max')">{{__(@$item->max)}}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" class="icon-btn ml-1 addBtn"
                                           data-original-title="@lang('Action')" data-toggle="tooltip"
                                           data-name="{{ @$item->name }}"
                                           data-price_per_k="{{ getAmount(@$item->rate) }}"
                                           data-min="{{ @$item->min }}" data-max="{{ @$item->max }}" data-api_service_id="{{ @$item->service }}">
                                            <i class="fa fa-fw fa-plus"></i>
                                            @lang('Add Service')
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
                    {{ paginateLinks($services) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>



    {{-- Add MODAL --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-share-square"></i> @lang('Add New')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('admin.services.store')}}">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label class="font-weight-bold ">@lang('Category') <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="category" required>
                                <option selected value="">@lang('Choose')...</option>

                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                @endforelse

                            </select>
                        </div>

                        <div class="form-row form-group">
                            <label class="font-weight-bold ">@lang('Name') <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control has-error bold " id="code" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Price Per 1k') <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername2" name="price_per_k" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">{{ $general->cur_text }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">@lang('Min')</label>
                                    <input type="text" name="min" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">@lang('Max')</label>
                                    <input type="text" name="max" class="form-control" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Details')</label>
                            <textarea class="form-control" name="details" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Service Id (If order process through API)')</label>
                            <input type="text" name="api_service_id" class="form-control" readonly required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary" id="btn-save" value="add">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text-white text--small" href="{{ route('admin.services.index') }}"><i
            class="fa fa-fw fa-backward"></i>@lang('Go Back')</a>
@endpush

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
            $('.addBtn').on('click', function () {
                var modal = $('#addModal');
                var name = $(this).data('name');
                var price_per_k = $(this).data('price_per_k');
                var min = $(this).data('min');
                var max = $(this).data('max');
                var api_service_id = $(this).data('api_service_id');

                modal.find('input[name=name]').val(name);
                modal.find('input[name=price_per_k]').val(price_per_k);
                modal.find('input[name=min]').val(min);
                modal.find('input[name=max]').val(max);
                modal.find('input[name=api_service_id]').val(api_service_id);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
