<form action="{{route('admins.update',$admin->id)}}" method="post" id="EditForm">
    @csrf
    @method("PUT")

    <div class="row g-4">
        <div class="form-group">
            <label for="name" class="form-control-label">{{trans('admin.image')}}</label>
            <input type="file" class="dropify" name="image" data-default-file="{{get_file($admin->image)}}" accept="image/*"/>
            <span class="form-text text-muted text-center">{{trans('admin.Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.')}}</span>
        </div>
        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">{{trans('admin.name')}}</span>
            </label>
            <!--end::Label-->
            <input type="text" required class="form-control form-control-solid" placeholder="{{trans('admin.name')}}"  name="name" value="{{$admin->name}}"/>
        </div>

        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">{{trans('admin.email')}}</span>
            </label>
            <!--end::Label-->
            <input type="email" required class="form-control form-control-solid"  placeholder=" {{trans('admin.email')}}" name="email" value="{{$admin->email}}"/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Phone</span>
            </label>
            <!--end::Label-->
            <input  id="phone" required type="text" class="form-control form-control-solid" placeholder=" " name="phone" value="{{$admin->phone}}"/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">  {{trans('admin.password')}}</span>
            </label>
            <!--end::Label-->
            <input type="password" class="form-control form-control-solid" placeholder="  {{trans('admin.password')}} " name="password" value=""/>
        </div>





    </div>
</form>
<script>
    $('.dropify').dropify();

</script>
