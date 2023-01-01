@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Brand List <span class="badge badge-pill badge-danger"> {{ count($brands) }} </span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Brand En</th>
                              <th>Brand Ar</th>
                              <th>Image</th>
                              <th>Action</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($brand as $brand )


                          <tr>
                              <td>{{ $brand->brand_name_en }} </td>
                              <td>{{ $brand->brand_name_ar }} </td>
                              <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name_en }}" style='width:70px;height:70px;'></td>
                              <td>
                                <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-info" title="Edit Data"><i class='fa fa-pencil' ></i></a>
                                <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-danger"  title="Delete Data"><i class='fa fa-trash' ></i></a>
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
                 <h3 class="box-title">Add Brand </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('brand.store')  }}" enctype="multipart/form-data" >
                                @csrf

                                    <div class="form-group">
                                        <h5>Brand Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_en" class="form-control" >
                                            @error('brand_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>Brand Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name_ar" class="form-control" >
                                            @error('brand_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Brand Image</h5>
                                        <div class="controls">
                                            <input type="file" name="brand_image" class="form-control" >
                                            @error('brand_image')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>





                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add brand</button>
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
