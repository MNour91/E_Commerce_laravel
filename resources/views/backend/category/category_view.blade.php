@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Category List <span class="badge badge-pill badge-danger"> {{ count($category) }} </span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                               <th>Icon</th>
                              <th>Category En</th>
                              <th>Category Ar</th>
                              <th>Action</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($category as $category )


                          <tr>
                              <span></span>
                             <td><i class="{{ $category->category_icon }}" ></i></td>
                              <td>{{ $category->category_name_en }} </td>
                              <td>{{ $category->category_name_ar }} </td>
                             
                              <td>
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info" title="Edit Data"><i class='fa fa-pencil' ></i></a>
                                <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger"  title="Delete Data"><i class='fa fa-trash' ></i></a>
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
                 <h3 class="box-title">Add Category </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('category.store')  }}" >
                                @csrf

                                    <div class="form-group">
                                        <h5>Category Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_en" class="form-control" >
                                            @error('category_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>Category Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="category_name_ar" class="form-control" >
                                            @error('category_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Category icon</h5>
                                        <div class="controls">
                                            <input type="text" name="category_icon" class="form-control" >
                                            @error('category_icon')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add category</button>
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
