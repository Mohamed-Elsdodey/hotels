<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('governorates.update',$row->id)}}">

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





    </div>
</form>
