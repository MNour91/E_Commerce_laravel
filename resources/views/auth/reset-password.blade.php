@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Reset Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-12 col-sm-12 sign-in">
	<h4 class="">Reset Password</h4>
	<p class="">Reset your Password</p>
	
      
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group">
                <label class="info-title" for="email">Email Address <span>*</span></label>
                <input type="email" class="form-control unicase-form-control text-input" id="email" name='email' value="{{ $request->email }}" required autocomplete="new-password" >
            </div>
            <div class="form-group">
                <label class="info-title" for="email">New Password <span>*</span></label>
                <input id="password"
                type="password" name="password" class="form-control unicase-form-control text-input" >
            </div>
            <div class="form-group">
                <label class="info-title" for="email">Confirm Password <span>*</span></label>
                <input id="password_confirmation" class="form-control unicase-form-control text-input" type="password" name="password_confirmation" required autocomplete="new-password"  >
            </div>
            
            
            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
        </form>					
    </div>


    </div><!-- /.row -->
</div><!-- /.sigin-in-->
<!-- ============================================== BRANDS CAROUSEL ============================================== -->
@include('frontend.body.brand')
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->





@endsection
