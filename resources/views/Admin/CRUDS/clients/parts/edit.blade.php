<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('clients.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name</span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" name="name" value="{{$row->name}}"/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="code" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Code</span>
            </label>
            <!--end::Label-->
            <input id="code" required type="text" class="form-control form-control-solid" name="code" value="{{$row->code}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Phone</span>
            </label>
            <!--end::Label-->
            <input id="phone" required type="text" class="form-control form-control-solid" name="phone" value="{{$row->phone}}"/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="governorate_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Governorate</span>
            </label>

            <select id="governorate_id" name="governorate_id" class="form-control">
                <option selected disabled>اختر المحافظة</option>
                @foreach($governorates as $governorate)
                    <option @if($row->governorate_id==$governorate->id) selected @endif value="{{$governorate->id}}">@if(app()->getLocale()=='ar')   {{$governorate->title_ar}}    @else  {{$governorate->title_en}}   @endif </option>
                @endforeach
            </select>

        </div>





        <div class="col-md-12 my-4">
            <label for="address">  Address  </label>

            <div class="form-floating ">

                            <textarea class="form-control " name="address" placeholder=""
                                      id="address">{{$row->address??''}}</textarea>
            </div>
        </div>





    </div>
</form>
