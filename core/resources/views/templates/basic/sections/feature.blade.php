@php
    $feature_elements = getContent('feature.element', false, null, true);
@endphp
@php
    $service_content = getContent('service.content', true);
    $service_elements = getContent('service.element', false, '', true);
@endphp
<!-- feature-section start -->

  <!-- <div class="row">
    <div class="col-sm div-3">

     <h1 class="text"> Influncer</h1>
    </div>
    <div class="col-sm div-2">
     <h1 class="text"> Virtual Market</h1>
    </div>
    <div class="col-sm div-1">
     <h1 class="text"> Delivrey</h1>
    </div>
  </div> -->
  @include($activeTemplate.'sections.action')

<section class="feature-section ptb-80" style="
    box-shadow: 10px 5px 5px #c2c2c299;
">
    <div class="container">
        <figure class="figure highlight-background highlight-background--lean-left">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1439px" height="480px">
                <defs>
                    <linearGradient id="PSgrad_1" x1="42.262%" x2="0%" y1="90.631%" y2="0%">
                        <stop offset="28%" stop-color="rgb(245,246,252)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(255,255,255)" stop-opacity="1" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                <path fill="url(#PSgrad_1)" d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
            </svg> -->
        </figure>
        <!-- <div class="row justify-content-center ml-b-30">

            @forelse($feature_elements as $item)
                <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                    <div class="feature-item text-center">
                        <div class="feature-icon">
                            @php echo @$item->data_values->icon @endphp
                        </div>
                        <div class="feature-content">
                            <h3 class="title">{{ __(@$item->data_values->title) }}</h3>
                            <p>{{ __(@$item->data_values->content) }}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div> -->

        @include($activeTemplate.'sections.sezOffers')
    </div>
</section>

<style>
    .text{
        display: flex;
  justify-content: center;
  align-items: center;
  overflow:hidden;
  color:white;
    }
    .wraper{
  width: 100%;
  height: 330px;
  background: #000;
  display: flex;
  overflow:hidden;
}
.wraper1{
  width: 100%;
  height: 330px;
  background: #000;
  overflow:hidden;
}
.div-1{
    display: flex;
  justify-content: center;
  align-items: center;
    background-image:  url("assets/images/frontend/hero/delivrey.jpg");
    background-size: cover;
  width: calc( 50% + 40px );
  height: 100%;
  /* background: #17274c; */
  /* border-left: 80px solid #ff005b; */
  border-bottom: 330px solid transparent;
  box-sizing: border-box;
  overflow:hidden;
  filter: grayscale(50%);

}
.div-2{
    background-image:  url("assets/images/frontend/hero/cc.jpg");
    background-size: cover;
  width: calc( 50% + 40px );
  height: 100%;
  /* background: #17274c; */
  /* border-left: 80px solid #ff005b; */
  border-bottom: 330px solid transparent;
  box-sizing: border-box;
  overflow:hidden;
  filter: grayscale(50%);

}
.div-3{
  width: calc( 50% + 40px );
  height: 100%;
  background-image:  url("assets/images/frontend/hero/influencer.jpg");
    background-size: cover;
  /* border-right: 80px solid #ff005b; */
  border-bottom: 330px solid transparent;
  box-sizing: border-box;
  overflow:hidden;
  filter: grayscale(50%);

}
.content{
    /* background-image:  url("assets/images/frontend/hero/cc.jpg"); */
  color: white;
  font-size: 16px;
  padding: 15px;
  overflow:hidden;
}
.box{
		width: 250px;
		margin: 0 10px;
		box-shadow: 0 0 20px 2px rgba(0, 0, 0, .1);
		transition: 1s;

	}
	.box img{
		display: block;
		width:100%;
		border-radius: 5px;
	}
	.box:hover{
		transform: scale(1.3);
		z-index: 2;
	}
</style>
<!-- feature-section end -->
