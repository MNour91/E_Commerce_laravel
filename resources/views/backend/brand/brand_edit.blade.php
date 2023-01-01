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
                 <h3 class="box-title">Edit Brand </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('brand.update',$brand->id)  }}" enctype="multipart/form-data" >
                                @csrf          
                            
                                    <div class="form-group">
                                        <h5>Brand Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_en" class="form-control"  value='{{ $brand->brand_name_en }}'>
                                            @error('brand_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>Brand Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_ar" class="form-control" value='{{ $brand->brand_name_ar }}'>
                                            @error('brand_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group">
                                            <h5>Brand Image</h5>
                                            <div class="controls">
                                                <input type="file" name="brand_image" class="form-control" id='image'>
                                                @error('brand_image')
                                                    <span class='text-danger' >{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                      </div><!-- end col 6 -->
                                      <div class="col-4">
                                        <img src="{{ asset($brand->brand_image) }}" width="200px" height='200px' id='new-image'>
                                      </div><!-- end col 4 -->

                                    </div>
                                    
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Update brand</button>
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