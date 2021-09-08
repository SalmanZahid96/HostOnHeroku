@php
    $action_content = getContent('action.content', true);
@endphp
<!-- action-section start -->
<section class="action-section ptb-80 bg_img" data-background="{{asset($activeTemplateTrue.'images/action-bg.png')}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="action-content">

                    <!-- <h2 class="title">{{ __(@$action_content->data_values->sub_heading) }}</h2> -->
                    <h2 class="title">Select your type of Business</h2>
</br>
</br>                    <!-- <h2 class="sub-title">Select your type of Business</h2> -->
                    <div class="action-btn">
                        <!-- <a href="{{ @$action_content->data_values->button_url }}" class="cmn-btn-active">{{ __(@$action_content->data_values->button) }}</a> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                        <div class="news-items" onclick="location.href='{{ route('contact') }}'" >
                            <div class="news-thumb">
                            <img class="img" src="{{ getImage('assets/images/frontend/blog/keagan-henman-ZqXXVeRCyZ0-unsplash.jpg', '800x600') }}" alt="news">

                                <strong class="carousel-projet-title"><span class="text-highlight-sub-lg" style="
    color: white;
" >Brands</span></strong>
                            </div></div></div>
                            <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                        <div class="news-items" onclick="location.href='{{ route('contact') }}'" style="cursor: pointer;">
                            <div class="news-thumb">
                            <img class="img" src="{{ getImage('assets/images/frontend/blog/Capture2.png', '600x400') }}" alt="news">
                            <strong class="carousel-projet-title"><span class="text-highlight-sub-lg" style="
    color: white;
">Stores</span></strong>
                            </div></div></div>
                            <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                        <div class="news-items" onclick="location.href='{{ route('contact') }}'" style="cursor: pointer;">
                            <div class="news-thumb">

                                <img class="img" src="{{ getImage('assets/images/frontend/blog/pexels-monstera-6999024.jpg', '600x400') }}" alt="news">
                                <strong class="carousel-projet-title part3"><span class="text-highlight-sub-lg" style="
    color: white;
">Service & individuals</span></strong>
                            </div></div></div>
        </div>
    </div>
</section>
<style>
    .carousel-projet-title {
    position: absolute;
    left: 0;
    top: 0;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 100%;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    font-size: 30px;
    }
    .part3 {
        font-size: 25px;
    }
    .news-items{
        filter: grayscale(100%);
    }
    .news-items:hover {

  filter: grayscale(0%);
}
</style>
<!-- action-section end -->
