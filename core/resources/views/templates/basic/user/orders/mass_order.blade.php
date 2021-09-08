@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="mass_order"
                                       class="font-weight-bold">@lang('Place mass order (Press Enter button for every new order)')
                                    <span class="text-danger">*</span></label>
                                <textarea name="mass_order" id="mass_order" rows="10" class="form-control"
                                          placeholder="service_id|link|quantity
service_id|link|quantity
service_id|link|quantity" required>{{ old('mass_order') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit"
                                        class="btn btn-block btn--primary mr-2">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
