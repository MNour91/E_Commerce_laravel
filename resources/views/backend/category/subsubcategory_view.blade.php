@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Sub->SubCategory List <span class="badge badge-pill badge-danger"> {{ count($subsubcategory) }} </span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                               <th>Category</th>
                               <th>SubCategory</th>
                              <th>SubSubCategory En</th>
                              <th>SubSubCategory Ar</th>
                              <th>Action</th>

                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($subsubcategory as $subsubcategory )


                          <tr>
                              <span></span>
                             <td>{{ $subsubcategory['Category']['category_name_en'] }}</td>
                             <td>{{ $subsubcategory['SubCategory']['subcategory_name_en'] }}</td>
                              <td>{{ $subsubcategory->subsubcategory_name_en }} </td>
                              <td>{{ $subsubcategory->subsubcategory_name_ar }} </td>

                              <td>
                                <a href="{{ route('subsubcategory.edit',$subsubcategory->id) }}" class="btn btn-info" title="Edit Data"><i class='fa fa-pencil' ></i></a>
                                <a href="{{ route('subsubcategory.delete',$subsubcategory->id) }}" class="btn btn-danger"  title="Delete Data" ><i class='fa fa-trash' ></i></a>
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
                 <h3 class="box-title">Add SubSubCategory </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('subsubcategory.store')  }}" >
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
                                    <h5 >Select SubCategory</h5>
                                    <select class="form-control" id="select" name='subcategory_id' required>
                                        <option value="" selected="" disabled="">Select SubCategory</option>

                                    </select>
                                     @error('subcategory_id')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                </div>
                                    <div class="form-group">
                                        <h5>SubSubCategory Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control" >
                                            @error('subsubcategory_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>SubSubCategory Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_ar" class="form-control" >
                                            @error('subsubcategory_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add subsubcategory</button>
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
        $(document).ready(function() {
          $('select[name="category_id"]').on('change', function(){
              var category_id = $(this).val();
              if(category_id) {
                  $.ajax({
                      url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });
      });
      </script>



@endsection
