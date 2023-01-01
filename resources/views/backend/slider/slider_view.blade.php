@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Slider List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                                <th>Image</th>
                              <th>Slider title</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($slider as $slider )


                          <tr>
                              <td><img src="{{ asset($slider->slider_img) }}" alt="{{ $slider->slider_img }}" style='width:70px;height:70px;'></td>
                              <td>
                                @if($slider->title == 1)
                                <span class="badge badge-pill badge-danger">Null</span>
                    
                                @else
                                {{ $slider->title }} 
                                @endif
                                </td>
                              <td>
                                @if($slider->description == Null)
                                <span class="badge badge-pill badge-danger">Null</span>
                    
                                @else
                                {{ $slider->description }}
                                @endif
                                </td>
                              <td> @if($slider->status == 1)
                                <span class="badge badge-pill badge-success">Active</span>
                    
                                @else
                                <span class="badge badge-pill badge-danger">InActive</span>
                                @endif</td>
                              <td >
                                <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-info" title="Edit Data" ><i class='fa fa-pencil' ></i></a>
                                <a href="{{ route('slider.delete',$slider->id) }}" class="btn btn-danger"  title="Delete Data"><i class='fa fa-trash' ></i></a>
                                @if($slider->status == 1)
                                <a href="{{ route('slider.inactive',$slider->id) }}" class="btn btn-danger" title="InActive Now"><i class="fa fa-arrow-down" '></i> </a>

                                @else
                                <a href="{{ route('slider.active',$slider->id) }}" class="btn btn-success" title="Active Now" ><i class="fa fa-arrow-up"></i> </a>
                                @endif
                              </td>

                          </tr>
                          @endforeach
                      </tbody>

                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Slider </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('slider.store')  }}" enctype="multipart/form-data" >
                                @csrf

                                    <div class="form-group">
                                        <h5>Slider Title </h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control" >
                                            @error('title')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>Slider Description </h5>
                                        <div class="controls">
                                            <textarea  name="description" class="form-control" ></textarea >
                                            @error('description')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <h5>Slider Image</h5>
                                        <div class="controls">
                                            <input type="file" name="slider_img" class="form-control" >
                                            @error('slider_image')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Slider</button>
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





@endsection
