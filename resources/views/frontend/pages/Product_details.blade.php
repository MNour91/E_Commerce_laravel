@extends('frontend.main_master')
@section('content')
    @section('title')
    @if(session()->get('language') == 'arabic')  {{  $product->Product_name_ar }} @else  {{  $product->product_name_en }} @endif

    @endsection

    @php
    $cat_id =  $product->category_id;
    $sub_id =  $product->subcategory_id;
    $subsub_id =  $product->subsubcategory_id;
    $categories = App\Models\Category::findOrFail($cat_id);
    $sub = App\Models\SubCategory::findOrFail($sub_id);
    $subsub = App\Models\SubSubCategory::findOrFail($subsub_id);

   @endphp
<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">

			<ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'arabic')
                    <li style='display: inline;'><a href="{{ url('/')}}">الصفحة الرئيسية</a></li>
                    <li style='display: inline;'>{{ $categories->category_name_ar }}</li>
                    <li style='display: inline;'>{{ $sub->subcategory_name_ar }}</li>
                    <li class='active' style='display: inline;'>{{ $subsub->subsubcategory_name_ar }}</li>
                 @else
                    <li style='display: inline;'><a href="{{ url('/')}}">Home</a></li>
                    <li style='display: inline;'>{{ $categories->category_name_en }}</li>
                    <li style='display: inline;'>{{ $sub->subcategory_name_en }}</li>
                    <li class='active' style='display: inline;' >{{ $subsub->subsubcategory_name_en }}</li>
                  @endif

			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
				<div class="home-banner outer-top-n">
<img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg ')}}" alt="Image">
</div>



    	<!-- ============================================== HOT DEALS ============================================== -->
        @include('frontend.common.hot_deals')
<!-- ============================================== HOT DEALS: END ============================================== -->

<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
	<h3 class="section-title">Newsletters</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<p>Sign Up for Our Newsletter!</p>
        <form>
        	 <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
			  </div>
			<button class="btn btn-primary">Subscribe</button>
		</form>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== Testimonials============================================== -->
@include('frontend.common.product_tags')

<!-- ============================================== Testimonials: END ============================================== -->



				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">

					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            @foreach ($multi as $img )


            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name) }}">
                    <img class="img-responsive" alt="" src="{{  asset('frontend/assets/images/blank.gif') }}" data-echo="{{ asset($img->photo_name) }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->
            @endforeach


        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                @foreach ($multi as $img )
                <div class="item">
                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{ $img->id }}" href="#slide{{ $img->id }}">
                        <img class="img-responsive" width="85" alt="" src="{{ asset('frontend/assets/images/blank.gif') }}" data-echo="{{ asset($img->photo_name) }}" />
                    </a>
                </div>
                @endforeach

            </div><!-- /#owl-single-product-thumbnails -->



        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name" id='pname'>@if(session()->get('language') == 'arabic')  {{  $product->Product_name_ar }} @else  {{  $product->product_name_en }} @endif</h1>

							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<div class="rating rateit-small"></div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">(13 Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">
                                                @if ($product->product_qty > 0)
                                                <span class="badge badge-pill badge-success" id="aviable" style="background: green; color: white;">
                                                    Aviable
                                                </span>
                                                @else
                                                <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;">Stockout</span>
                                                @endif


                                          </span>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
								@if(session()->get('language') == 'arabic')  {{  $product->short_descp_ar }} @else  {{  $product->short_descp_en }} @endif
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">


									<div class="col-sm-6">
										<div class="price-box">
                                            @if ( $product->discount_price == Null)
                                            <span class="price">${{  $product->selling_price }}</span>
                                            @else
                                            <span class="price">${{  $product->discount_price }}</span>
											<span class="price-strike">${{  $product->selling_price }}</span>
                                            @endif

										</div>
									</div>

									<div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
											    <i class="fa fa-heart"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
											   <i class="fa fa-signal"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
											    <i class="fa fa-envelope"></i>
											</a>
										</div>
									</div>

								</div><!-- /.row -->

							</div><!-- /.price-container -->



                            {{-- ///ADD Color And Size --}}

                            <div class="row">


                                <div class="col-sm-6">

                            <div class="form-group">

                                <label class="info-title control-label">Choose Color <span> </span></label>
                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id='color'>
                                    <option selected="" disabled="">--Choose Color--</option>
                                    @foreach($product_color_en as $color)
                                    <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                    @endforeach
                                </select>

                            </div> <!-- // end form group -->

                                </div>{{-- end col 6 --}}

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        @if ($product->product_size_en == null)

                                        @else
                                            <label class="info-title control-label">Choose Size <span> </span></label>
                                            <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size">
                                                <option selected="" disabled="">--Choose Size--</option>
                                                @foreach($product_size_en as $size)
                                                <option value="{{ $size }}">{{   ucwords($size)  }}</option>
                                                @endforeach
                                            </select>
                                        @endif


                                    </div> <!-- // end form group -->
                                </div>{{-- end col 6 --}}

                            </div><!-- /.row -->

                            {{-- ////////////END Color And Size --}}

							<div class="quantity-container info-container">
								<div class="row">

									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>

									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1" id='qty' min='1'>
							              </div>
							            </div>
									</div>
                                    <input type="hidden" value="{{  $product->id }}" id='product_id' min='1'>
									<div class="col-sm-7">
										<button class="btn btn-primary" type='submit' onclick="addToCart()"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
									</div>


								</div><!-- /.row -->
							</div><!-- /.quantity-container -->


                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            




						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>

				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
								<li><a data-toggle="tab" href="#tags">TAGS</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">

								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">@if(session()->get('language') == 'arabic')  {!! $product->long_descp_ar !!} @else  {!!  $product->long_descp_en !!} @endif</p>
									</div>
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
	<div class="product-tab">

		<div class="product-reviews">
			<h4 class="title">Customer Reviews</h4>

			@php
                $reviews = App\Models\Review::where('product_id',$product->id)->latest()->limit(5)->get();
            @endphp			

	<div class="reviews">

		@foreach($reviews as $item)
		@if($item->status == 0)

		@else

		<div class="review">

        <div class="row">
			<div class="col-md-3">
			<img style="border-radius: 50%" src="{{ (!empty($item->user->profile_photo_path))? url('upload/user_images/'.$item->user->profile_photo_path):url('upload/no_image.png') }}" width="40px;" height="40px;"><b> {{ $item->user->name }}</b>
			</div>

			<div class="col-md-9">

			</div>			
		</div> <!-- // end row -->



			<div class="review-title"><span class="summary">{{ $item->summary }}</span><span class="date"><i class="fa fa-calendar"></i><span> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></span></div>
			<div class="text">"{{ $item->comment }}"</div>
		 </div>

		 @endif
	@endforeach
	</div><!-- /.reviews -->

		</div><!-- /.product-reviews -->

        <div class="product-add-review">
            <h4 class="title">Write your own review</h4>
            <div class="review-table">

            </div><!-- /.review-table -->

 <div class="review-form">
 @guest
    <p> <b> For Add Product Review. You Need to Login First <a href="{{ route('login') }}">Login Here</a> </b> </p>

    @else 

    <div class="form-container">

<form role="form" class="cnt-form" method="post" action="{{ route('review.store') }}">
@csrf

<input type="hidden" name="product_id" value="{{ $product->id }}">

<div class="row">
<div class="col-sm-6">

    <div class="form-group">
        <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
        <input type="text" name="summary" class="form-control txt" id="exampleInputSummary" placeholder="">
    </div><!-- /.form-group -->
</div>

                                        </div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputReview">Review <span class="astk">*</span></label>
        <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4" placeholder=""></textarea>
    </div><!-- /.form-group -->
</div>
</div><!-- /.row -->

<div class="action text-right">
    <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>

</div><!-- /.action -->

</form><!-- /.cnt-form -->
    </div><!-- /.form-container -->

@endguest									
</div><!-- /.review-form -->

</div><!-- /.product-add-review -->										

</div><!-- /.product-tab -->
</div><!-- /.tab-pane -->

<div id="tags" class="tab-pane">
<div class="product-tag">

<h4 class="title">Product Tags</h4>
<form role="form" class="form-inline form-cnt">
    <div class="form-container">

        <div class="form-group">
            <label for="exampleInputTag">Add Your Tags: </label>
            <input type="email" id="exampleInputTag" class="form-control txt">


        </div>

        <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
    </div><!-- /.form-container -->
</form><!-- /.form-cnt -->

<form role="form" class="form-inline form-cnt">
    <div class="form-group">
        <label>&nbsp;</label>
        <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
    </div>
</form><!-- /.form-cnt -->
								



												

										

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ============================ UPSELL PRODUCTS ======================= -->
        <section class="section featured-product wow fadeInUp">
            <h3 class="section-title">RELATED PRODUCTS</h3>
            <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                @foreach($relatedproduct as $product)
                <div class="item item-carousel">
                    <div class="products">

                        <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" data-echo="{{ asset($product->product_thambnail) }}" alt=""></a>
                                    </div><!-- /.image -->
                                        @php
                                        $amount =   $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price)*100;
                                        @endphp
                                    <div class="sale-offer-tag"><span>{{ round($discount) }}%</span></div>
                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en) }}">@if(session()->get('language') == 'arabic') {{ $product->product_name_ar }} @else {{ $product->product_name_en }} @endif</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>

                                    <div class="product-price">
                                        <span class="price"> ${{ $product->discount_price }} </span> <span class="price-before-discount">${{ $product->selling_price }}</span>
                                    </div><!-- /.product-price -->

                                </div><!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>

                                                </li>

                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>

                                                <li class="lnk">
                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /.action -->
                                    </div><!-- /.cart -->
                        </div><!-- /.product -->

                    </div><!-- /.products -->
                </div><!-- /.item -->
                @endforeach
            </div><!-- /.home-owl-carousel -->
        </section><!-- /.section -->
        <!-- ============================== UPSELL PRODUCTS : END ========================= -->

			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->


        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-636b15b9eb20fdb7"></script>


@endsection
