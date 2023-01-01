@php
 $categories = App\Models\Category::orderBy('category_name_en',"ASC")->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">

     @foreach($categories as $category)
        <li class="dropdown menu-item"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>@if(session()->get('language') == 'arabic') {{ $category->category_name_ar }} @else {{ $category->category_name_en }} @endif</a>
            @php
            $cat_id =  $category->id;
            $subcategories = App\Models\SubCategory::where("category_id",$cat_id)->orderBy('subcategory_name_en',"ASC")->get();
           @endphp
            <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
                @php
                $cat_id =  $category->id;
                $subcategories = App\Models\SubCategory::where("category_id",$cat_id)->orderBy('subcategory_name_en',"ASC")->get();
               @endphp
             @foreach ($subcategories as $sub)
                <div class="col-sm-12 col-md-3">
                  <ul class="links list-unstyled">
                    <li><a href="{{ url('subcategory/product/'.$sub->id.'/'. $sub->subcategory_slug_en) }}" style='font-size:900'>@if(session()->get('language') == 'arabic') {{ $sub->subcategory_name_ar }} @else {{ $sub->subcategory_name_en }}@endif</a></li>
                    @php
                      $subcat_id=  $sub->id;
                      $subsubcategories = App\Models\SubSubCategory::where("subcategory_id",$subcat_id)->orderBy('subsubcategory_name_en',"ASC")->get();
                     @endphp
                        @foreach ($subsubcategories as $subsub)
                        <li><a href="{{ url('subsubcategory/product/'.$subsub->id.'/'. $subsub->subsubcategory_slug_en) }}">
                            @if(session()->get('language') == 'arabic') {{ $subsub->subsubcategory_name_ar }} @else {{ $subsub->subsubcategory_name_en }}
                            @endif
                        </a></li>
                        @endforeach

                  </ul>
                </div>
                <!-- /.col -->
                   @endforeach
              </div>
              <!-- /.row -->
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
         @endforeach


        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
          <!-- ================================== MEGAMENU VERTICAL ================================== -->
          <!-- /.dropdown-menu -->
          <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
        <!-- /.menu-item -->

        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->

      </ul>
      <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
  </div>
  <!-- /.side-menu -->
