@extends('admin.admin_master')

@section('admin')


<div class="container-full">

	<section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Admin Change Password</h4>
             
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                    <form  method="POST" action="{{ route('admin.password.update')  }}" >
                          @csrf          
                        <div class='row'>

                            <div class='col-md-12'>
                                <div class="form-group">
                                    <h5>Admin Password Current </h5>
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
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Password</button>
                        </div>
                          
                      
                    </form>

               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->

       </section>



</div>





@endsection