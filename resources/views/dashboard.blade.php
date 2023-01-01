@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <br>
                @include('frontend.common.user_sidebar')

                <div class="col-md-2">

                </div><!-- end col-md-2 -->

                <div class="col-md-6">
                    <div class="card">
                        <br>
                        <h3 class="text-center "><span class="text-danger">Hi.... </span><strong>{{ Auth::user()->name }} <br> <br></strong> Welcome To Nour Online Shop </h3>
                    </div>

                </div><!-- end col-md-6 -->


            </div><!-- end row -->
        </div>
        
    </div>

@endsection