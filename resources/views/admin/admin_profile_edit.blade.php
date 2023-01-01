@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">

	<section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Admin Profile Edit</h4>
             
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                    <form  method="POST" action="{{ route('admin.profile.store')  }}" enctype="multipart/form-data">
                          @csrf          
                        <div class='row'>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <h5>Admin Name  </h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required value="{{ $editData->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <h5>Your Email  </h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required value="{{ $editData->email }}" >
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <h5>Profile Image</h5>
                                    <div class="controls">
                                        <input type="file" name="profile_photo_path" class="form-control" required id="image">
                                    </div>
                                </div>
                            </div>

                            <div class='col-md-6'>  
                                <img src="{{ (!empty($editData->profile_photo_path))? url('upload/admin_images/'.$editData->profile_photo_path):url('upload/no_image.jpg') }}" style='width:100px;height:100px' id='newImage'>
                            
                            </div> 
                        </div>

                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Profile</button>
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