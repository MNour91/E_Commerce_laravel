@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="body-content">
        <div class="container">
            <div class="row">
                <br>
                @include('frontend.common.user_sidebar')

                <div class="col-md-2">

                </div><!-- end col-md-2 -->

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center "><span class="text-danger">Hi.... </span><strong>{{ Auth::user()->name }} <br></strong>Update Your Profile </h3>
                        <div class="card-body">
                            <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    
                                    <label class="info-title" for="name">Name </label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="name" name='name' value="{{ $user->name }}" >
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Email </label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="email" name='email'value="{{ $user->email }}" >
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone</label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="phone" name='phone' value="{{ $user->phone }}" >
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Profile Image</label>
                                    <input type="file" class="form-control unicase-form-control text-input" id="image" name='profile_photo_path' >
                                </div>

                                <button type="submit" class="btn btn-warning btn-block"><i class='fa fa-edit'></i>  Update Profile </button>

                            </form>
                            <br><br>
                        </div>

                    </div>


                </div><!-- end col-md-6 -->


            </div><!-- end row -->
        </div>
        
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader= new FileReader();
                reader.onload = function(e){
                    $('#newImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
        
        
        
        
            });
        });
    
    </script>

@endsection