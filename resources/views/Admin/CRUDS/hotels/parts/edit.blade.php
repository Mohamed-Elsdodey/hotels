<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('hotels.update',$hotels->id)}}">

    @csrf
    @method('PUT')
    <div class="row g-4">



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Hotel</span>
            </label>
            <!--end::Label-->
            <input id="name"  type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{ $hotels->name }}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> number of floor</span>
            </label>
            <!--end::Label-->
            <input id="num_floor"  type="text" class="form-control form-control-solid" placeholder="" name="num_floor" value=" {{ $hotels->num_floor }} "/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> adress</span>
            </label>
            <!--end::Label-->
            <input id="adress"  type="text" class="form-control form-control-solid" placeholder="" name="adress" value=" {{ $hotels->adress }}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> description</span>
            </label>

            <textarea name="description" class="form-control form-control-solid" > {{ $hotels->description }} </textarea>
        </div>



    </div>
</form>

