<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('roomsfeatures.update',$RoomsFeature->id)}}">

    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> title (arabic)</span>
            </label>
            <!--end::Label-->
            <input id="title_ar"  type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value="{{ $RoomsFeature->title_ar }}"/>
        </div>




        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> title (english)</span>
            </label>
            <!--end::Label-->
            <input id="title_en"  type="text" class="form-control form-control-solid" placeholder="" name="title_en" value=" {{ $RoomsFeature->title_en }}"/>
        </div>






    </div>
</form>

