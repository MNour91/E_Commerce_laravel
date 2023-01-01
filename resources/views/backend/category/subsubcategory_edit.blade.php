@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Sub Sub Category </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('subsubcategory.update',$subsubcategory->id)  }} ">
                                @csrf
                                <div class="form-group">
                                    <h5 >Select Category</h5>
                                    <select class="form-control" id="select" name='category_id' required>
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category )
                                         <option value="{{ $category->id }}" @if ($subsubcategory->category_id == $category->id)
                                            selected
                                        @endif>{{ $category->category_name_en }}</option>
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
                                        @foreach ($subcategories as $subcategory )
                                        <option value="{{ $subcategory->id }}" {{ $subsubcategory->subcategory_id == $subcategory->id ?'selected':" "  }}>{{ $subcategory->subcategory_name_en }}</option>
                                      @endforeach
                                    </select>
                                     @error('subcategory_id')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                </div>
                                    <div class="form-group">
                                        <h5>SubSubCategory Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control" value='{{ $subsubcategory->subsubcategory_name_en }}' >
                                            @error('subsubcategory_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>SubSubCategory Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_ar" class="form-control" value='{{ $subsubcategory->subsubcategory_name_ar }}' >
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

    


@endsection
