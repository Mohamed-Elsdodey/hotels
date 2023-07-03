<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('admins.store')}}">
    @csrf
    <div class="row g-4">

        <div class="form-group">
            <label for="name" class="form-control-label">{{trans('admin.image')}} <span class="red-star">*</span></label>
            <input type="file" class="dropify" name="image" data-default-file="" accept="image/*"/>
            <span class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">{{trans('admin.name')}} <span class="red-star">*</span></span>
            </label>
            <!--end::Label-->
            <input required type="text" class="form-control form-control-solid" placeholder="" name="name" value=""/>
        </div>

        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">{{trans('admin.email')}} </span>
                <span class="red-star">*</span>
            </label>
            <!--end::Label-->
            <input required type="email" class="form-control form-control-solid" placeholder=" {{trans('admin.email')}}" name="email" value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Phone</span>
                <span class="red-star">*</span>
            </label>
            <!--end::Label-->
            <input  id="phone" type="text" class="form-control form-control-solid" placeholder=" " name="phone" value=""/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">{{trans('admin.password')}}</span>
                <span class="red-star">*</span>
            </label>
            <!--end::Label-->
            <input type="password" class="form-control form-control-solid" placeholder=" " name="password" value=""/>
        </div>



        <div class="d-flex align-items-center justify-content-between flex-wrap col-md-6 my-4 ">
            <div class="form-check">
                <input class="form-check-input filterCoupon" data-type="owner" type="radio" name="is_active" id="exampleRadios1" value="1" >
                <label class="form-check-label" for="exampleRadios1">
                    {{trans('admin.enable')}}
                </label>
            </div>


            <div class="form-check">
                <input class="form-check-input filterCoupon" type="radio" data-type="owner" name="is_active" id="exampleRadios1" value="0" >
                <label class="form-check-label" for="exampleRadios1">
                     {{trans('admin.not enable')}}
                </label>
            </div>


        </div>




        <div class="d-flex justify-content-center my-2">
            <h2>الادوار</h2>
        </div>



        <div class="row my-4">
            @foreach($roles as $role)

                <span class="form-check col-md-4  ">
                  <input class="form-check-input " type="checkbox" name="roles[]"  value="{{$role->id}}" id="flexCheckDefault{{$role->id}}">
                  <label class="form-check-label mx-1" for="flexCheckDefault{{$role->id}}">
                   {{$role->name}}
                  </label>
                </span>
            @endforeach
        </div>




    </div>
</form>
<script>
    $('.dropify').dropify();

</script>
