@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-full">
      

      <!-- Main content -->
      <section class="content">
        <div class="row">
          
          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Slider </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('slider.update',$slider->id)  }}" enctype="multipart/form-data" >
                                @csrf          
                            
                                    <div class="form-group">
                                        <h5>Slider Title </h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control"  value='{{ $slider->title }}'>
                                            @error('title')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>Slider description </h5>
                                        <div class="controls">
                                            <input type="text" name="description" class="form-control" value='{{ $slider->description }}'>
                                            @error('description')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group">
                                            <h5>Slider Image</h5>
                                            <div class="controls">
                                                <input type="file" name="slider_img" class="form-control" id='image'>
                                                @error('slider_img')
                                                    <span class='text-danger' >{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                      </div><!-- end col 6 -->
                                      <div class="col-4">
                                        <img src="{{ asset($slider->slider_img) }}" width="200px" height='200px' id='new-image'>
                                      </div><!-- end col 4 -->

                                    </div>
                                    
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Update slider</button>
                                </div>
                                
                            
                        </form>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
 
            
             <!-- /.box -->          
           </div>
           <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader= new FileReader();
                reader.onload = function(e){
                    $('#new-image').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
        
        
        
        
            });
        });
    
    </script>



@endsection