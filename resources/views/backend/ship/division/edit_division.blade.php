@extends('admin.admin_master')
@section('admin')


    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Division </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                        <form  method="POST" action="{{ route('division.update',$division->id)  }}"  >
                                @csrf

                                    <div class="form-group">
                                        <h5>Division Name </h5>
                                        <div class="controls">
                                            <input type="text" name="division_name" class="form-control"  value='{{ $division->division_name }}'>
                                            @error('division_name')
                                                <span class='text-danger' >{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Update division</button>
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
