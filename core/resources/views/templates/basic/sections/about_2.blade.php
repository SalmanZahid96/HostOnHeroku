@php
    $about2_content = getContent('about_2.content', true);
@endphp
<!-- about-section start -->
<i class="las la-mobile-alt"></i>
<section class="about-section ptb-80">
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

                    <span class="sub-title"><div class="service-icon">
                        <i class="las la-mobile-alt"></i>  </div></span>
                    <h2 class="section-title" style="color: #000000;">Accessibility </h2>
                    <span class="title-border"></span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30">
            <div class="col-lg-6 mrb-30">
                <div class="about-content">
                    <h1 class="title" style="font-size: 58px;color: #031c6c;">Sez Market <span style="color: #ffa900;">.</span></h1>
                    <span class="title-border"></span>
                    <p>sez markets is an ecommercee app thats helps you as shopkeeper or service provider to reach a wider cercle of clients just by creating a profile with sez markets ,then  putting what you have to offer or sell</p>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 mrb-30"><a class="store-button android" href="https://play.google.com/store/apps/details?id=com.sez.markets" target="_blank">
												<img style="margin-bottom: 20px;" src="https://cdn.flycricket.com/images/appstore/android.png">
												</a></div>
                        <div class="col-lg-6 col-sm-6 mrb-30">
                            <a class="store-button android" href="https://apps.apple.com/us/app/sez/id1577247746">
								<img style="
													width: 268px;
													height: 78px;
													margin-bottom: 20px;
												" src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/en-us?size=250x83&amp;releaseDate=1580688000&amp;h=a9775910b8ad162a800e3b48ae4c5c30" alt="Download on the App Store">
												</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mrb-30">
                <div class="about-thumb-two">
                    <img src="{{ getImage('assets/images/frontend/about_2/mockupvrai.png', '569x402') }}" alt="about">
                </div>
            </div>
        </div>
</br></br></br></br></br></br></br></br>

            <iframe style="display:block; margin: 0 auto;" width="800" height="515" src="https://www.youtube.com/embed/U0LOiQLwY9s" frameborder="0" allowfullscreen></iframe>
    </div>


</section>
@include($activeTemplate.'sections.mediaChannel1')
<!-- about-section end -->
