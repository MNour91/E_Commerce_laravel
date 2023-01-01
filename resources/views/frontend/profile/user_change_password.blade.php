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
                        <h3 class="text-center "><span class="text-danger">Hi.... </span><strong>{{ Auth::user()->name }} <br></strong>Change Your Password </h3>
                        <div class="card-body">
                            <form  method="POST" action="{{ route('user.password.update')  }}" >
                                @csrf          
                              <div class='row'>
      
                                  <div class='col-md-12'>
                                      <div class="form-group">
                                          <h5>Current Password  </h5>
                                          <div class="controls">
                                              <input type="password" name="oldpassword" class="form-control" required  id="current_password">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class='row'>
                                  <div class='col-md-12'>
                                      <div class="form-group">
                                          <h5>New Password </h5>
                                          <div class="controls">
                                              <input type="password" name="password" class="form-control" required  autocomplete="new-password" id='password'>
                                          </div>
                                      </div>
                                  </div>
      
      
                              </div>
                              <div class='row'>
                                  <div class='col-md-12'>
                                      <div class="form-group">
                                          <h5>Password Confirm </h5>
                                          <div class="controls">
                                              <input type="password" name="password_confirmation" id='password_confirmation' class="form-control" required autocomplete="new-password" >
                                          </div>
                                      </div>
                                  </div>
      
      
                              </div>
      
                              
      
                              <div class="text-xs-right">
                                  <button type="submit" class="btn btn-rounded btn-primary mb-5 btn-block">Update Password</button>
                              </div>
                                
                            
                          </form>
                            <br><br>
                        </div>

                    </div>


                </div><!-- end col-md-6 -->


            </div><!-- end row -->
        </div>
        
    </div>
   

@endsection