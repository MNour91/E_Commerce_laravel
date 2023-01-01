@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit SubCategory </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('subcategory.update',$subcategory->id)  }}"  >
                                @csrf
                                <div class="form-group">
                                    <h5 >Select Category</h5>
                                    <select class="form-control" id="select" name='category_id' required>
                                        <option value="" disabled="">Select Category</option>
                                        @foreach ($categories as $category )
                                         <option value="{{ $category->id }}" @if ($subcategory->category_id == $category->id)
                                             selected
                                         @endif >{{ $category->category_name_en }}</option>
                                       @endforeach
                                    </select>
                                     @error('category_id')
                                                <span class='text-danger' >{{ $message }}</span>
                                         @enderror
                                </div>

                                    <div class="form-group">
                                        <h5>SubCategory Name En </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" class="form-control"  value='{{ $subcategory->subcategory_name_en }}'>
                                            @error('subcategory_name_en')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <h5>SubCategory Name Arb </h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_ar" class="form-control" value='{{ $subcategory->subcategory_name_ar }}'>
                                            @error('subcategory_name_ar')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Update subcategory</button>
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
