<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
      <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
        @php
          $brands =  App\Models\Brand::orderBy('id',"DESC")->get();
        @endphp
        @foreach ($brands as $brand)

        <div class="item m-t-10 "> <a href="#" class="image"> <img data-echo="{{ asset($brand->brand_image)}}" src="{{ asset('frontend/assets/images/blank.gif')}}" alt="" height='100px'width='150px'> </a> </div>
        <!--/.item-->
        @endforeach
        

 
        <!--/.item-->
      </div>
      <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

  </div>