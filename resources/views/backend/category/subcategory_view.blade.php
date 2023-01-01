@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">SubCategory List <span class="badge badge-pill badge-danger"> {{ count($subcategory) }} </span> </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                               <th>Category</th>
                              <th>SubCategory En</th>
                              <th>SubCategory Ar</th>
                              <th>Action</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($subcategory as $subcategory )


                          <tr>
                              <span></span>
                             <td>{{ $subcategory['Category']['category_name_en'] }}</td>
                              <td>{{ $subcategory->subcategory_name_en }} </td>
                              <td>{{ $subcategory->subcategory_name_ar }} </td>

                              <td>
                                <a href="{{ route('subcategory.edit',$subcategory->id) }}" class="btn btn-info" title="Edit Data"><i class='fa fa-pencil' ></i></a>
                                <a href="{{ route('subcategory.delete',$subcategory->id) }}" class="btn btn-danger"  title="Delete Data"><i class='fa fa-trash' ></i></a>
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
                 <h3 class="box-title">Add SubCategory </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('subcategory.store')  }}" >
                                @csrf
                                <div class="form-group">
                                    <h5 >Select Category</h5>
                                    <select class="form-control" id="select" name='category_id' required>
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category )
                                         <option value="{{ $category->id }}" >{{ $category->category_name_en }}</option>
                                       @endforeach
                                    </select>
                                     @error('category_id')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                </div>
                                    <div class="form-group">
                                        <h5>SubCategory Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" class="form-control" >
                                            @error('subcategory_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>SubCategory Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_ar" class="form-control" >
                                            @error('subcategory_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add subcategory</button>
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
