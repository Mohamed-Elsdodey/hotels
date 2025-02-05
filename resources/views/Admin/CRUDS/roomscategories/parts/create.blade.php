<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('roomcategory.store')}}">
    @csrf
    <div class="row g-4">
        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Type Category</span>
            </label>
            <!--end::Label-->
            <select id="type" name="type" class="form-control" fdprocessedid="4rrte">

                <option selected="" disabled=""> choose type</option>
                @foreach($category_types as $key=>$value)
             <option value="{{ $key }}"> {{ $value }} </option>

                @endforeach

            </select>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">title (arabic)</span>
            </label>
            <!--end::Label-->
            <input id="title_ar"  type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value=""/>
        </div>







        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> title (English)</span>
            </label>

            <input id="title_en"  type="text" class="form-control form-control-solid" placeholder="" name="title_en" value=""/>
        </div>



    </div>
</form>

