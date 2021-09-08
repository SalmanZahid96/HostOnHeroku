@php
    $about3_content = getContent('about_3.content', true);
@endphp

<!-- about-section start -->
<section class="about-section ptb-80" style="
    box-shadow: 10px 5px 5px #c8c6c6;
">


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
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-header">
                    <span class="sub-title">Sez</span>
                    <h2 class="section-title" style="color: #000000;">Globality </h2>
                    <span class="title-border"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30">
            <div class="col-lg-6 mrb-30">
                <div class="about-thumb">
                <img src="assets/images/frontend/about_3/photo1.jpg" alt="about" style="
    width: 500px;
    height: 600px;
">
                </div>
            </div>
            <div class="col-lg-6 mrb-30">
                <div class="about-content">
                    <h2 class="title" style="color: #031c6c;">Delivrey</h2>
                    <span class="title-border"></span>
                    <p style="color: black;">Sez offers a delivrey service to help you get in touch with your custumers and reach large custemers in easy and fast delivrey within 24 hour !  </p>
                </div>
            </div>
        </div>

    </div>

</section>


<!-- about-section end -->
