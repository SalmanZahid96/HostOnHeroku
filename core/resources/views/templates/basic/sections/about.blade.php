@php
    $about_content = getContent('about.content', true);
@endphp
<!-- about-section start -->
<section class="about-section_sezmedia about-section ptb-80"  id="about">
    <div class="about-shape-one">
        <img src="{{asset($activeTemplateTrue.'images/banner/icon-1.png')}}" alt="shape">
    </div>
    <div class="about-shape-two">
        <img src="{{asset($activeTemplateTrue.'images/banner/icon-2.png')}}" alt="shape">
    </div>
    <div class="about-shape-three">
        <img src="{{asset($activeTemplateTrue.'images/banner/icon-3.png')}}" alt="shape">
    </div>
    <div class="container">
        <figure class="figure highlight-background highlight-background--lean-left">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1439px" height="480px"> -->
                <defs>
                    <linearGradient id="PSgrad_2" x1="42.262%" x2="0%" y1="90.631%" y2="0%">
                        <stop offset="28%" stop-color="rgb(245,246,252)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(255,255,255)" stop-opacity="1" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                <path fill="url(#PSgrad_2)" d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
            </svg>
        </figure>
        <!-- <div class="row">
                        <div class="col-lg-6 col-sm-6 mrb-30">
                            <img src="{{ getImage('assets/images/frontend/about/logo_yellow.png' , '518x499') }}" alt="about">
                        </div>
                        <div class="col-lg-6 col-sm-6 mrb-30"><img src="{{ getImage('assets/images/frontend/about/logo_yellow.png' , '518x499') }}" alt="about"></div>
                    </div> -->

                    <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-header">
                    <span class="sub-title">Sez</span>
                    <h2 class="section-title" style="color: #000000;">Advertisment </h2>
                    <span class="title-border"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30" >
            <div class="col-lg-6 mrb-30">
                <div class="about-thumb">
                    <img src="{{ getImage('assets/images/frontend/about/postvrai3.png' , '518x499') }}" alt="about" style="
    width: 435px;
">
                </div>
            </div>
            <div class="col-lg-6 mrb-30 "style="
    margin-bottom: 130px;
">
                <div class="about-content">
                <div ><img src="{{ getImage('assets/images/frontend/about/logo2_yellow gradient.png' , '518x499') }}" alt="about"></div>
                    <!-- <h2 class="title">{{ __(@$about_content->data_values->title) }}</h2> -->
                    <!-- <span class="title-border"></span> -->
                    <p style="color: #000000;">      Sez Media is an online media , composed of some series of small shows presented by a group of influencers , sez media with her devirsty show give in your hand a large community to promoteyour buissnis ..by using our show to target the most people that are intrested in your buissnis and also get a new clients . </p>

                </div>
            </div>
            </br>
</br>
</br>
            <!-- <div class="col-lg-8 text-center">
                <div class="section-header" style="
    margin-bottom: 9px;
" >

                    <h2 class="section-title" style="color: #ffffff;">Our Shows </h2>
                    <span class="title-border"></span>
                </div>
            </div> -->
        </div>
        </div>

    </div>

</section>

<div style="
    background-color: black;">

</div>
<!-- <div class="bloc-content"style="
    background-color: black;
"><img src="{{ getImage('assets/images/frontend/about/611e4797d15b6cd57f2c8ffd_PLAYLIST DESKTOP-p-1600.png' ) }}" loading="lazy"  alt="" class="desktop-playlist hide-mobile"><div class="w-layout-grid grid-playlist-mobile hide spacing9"><div></div></div></div> -->
@include($activeTemplate.'sections.mediaChannel')
<!-- about-section end -->
