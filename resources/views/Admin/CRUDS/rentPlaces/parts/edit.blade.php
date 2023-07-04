<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('rent_places.update',$row->id)}}">

    @csrf
    @method('PUT')
    <div class="row g-4">




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title_ar" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title In Arabic</span>
            </label>
            <!--end::Label-->
            <input id="title_ar"  type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value="{{$row->title_ar}}"/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title_en" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title In English</span>
            </label>
            <!--end::Label-->
            <input id="title_en"  type="text" class="form-control form-control-solid" placeholder="" name="title_en" value="{{$row->title_en}}"/>
        </div>


        <div class="col-sm-6 pb-3 p-2">
            <label for="desc_ar" class="form-label"> Description In Arabic  </label>


            <textarea name="desc_ar" id="desc_ar" class="form-control" rows="5"
                      placeholder="">{{$row->desc_ar}}</textarea>
        </div>


        <div class="col-sm-6 pb-3 p-2">
            <label for="desc_en" class="form-label"> Description In English  </label>


            <textarea name="desc_en" id="desc_en" class="form-control" rows="5"
                      placeholder="">{{$row->desc_en}}</textarea>
        </div>








        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="category_rent_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Rent Category</span>
            </label>
            <!--end::Label-->

            <select id="category_rent_id" name="category_rent_id"  class="form-control" >

                <option selected disabled> chose  Category</option>
                @foreach($rentCategories as $category)

                    <option @if($row->category_rent_id==$category->id) selected @endif value="{{$category->id}}">@if(app()->getLocale()=='ar'){{$category->title_ar}} @else {{$category->title_en}} @endif</option>

                @endforeach

            </select>

        </div>

    </div>
</form>

