<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('rooms.update',$Room->id)}}">

    @csrf
    @method('PUT')
    <div class="row g-4">

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Room number </span>
            </label>
            <!--end::Label-->
            <input id="room_number"  type="text" class="form-control form-control-solid" placeholder="" name="room_number" value="{{$Room->room_number}}"/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">title (arabic)</span>
            </label>
            <!--end::Label-->
            <input id="title_ar"  type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value="{{$Room->title_ar}}"/>
        </div>







        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> title (English)</span>
            </label>

            <input id="title_en"  type="text" class="form-control form-control-solid" placeholder="" name="title_en" value="{{$Room->title_en}}"/>
        </div>








        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Hotel</span>
            </label>
            <!--end::Label-->
            <select id="hotel_id" name="hotel_id" class="form-control" fdprocessedid="4rrte">

                <option selected="" disabled=""> choose type</option>
                @foreach($hotels as $key)
                    <option value="{{ $key->id }}" @if($key->id == $Room->hotel_id) selected @endif > {{ $key->name }} </option>

                @endforeach

            </select>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Category</span>
            </label>
            <!--end::Label-->
            <select id="room_category" name="room_category" class="form-control" fdprocessedid="4rrte">

                <option selected="" disabled=""> choose type</option>
                @foreach($Roomstypes as $key)
                    <option value="{{ $key->id }}" @if($key->id == $Room->room_category) selected @endif  > {{ $key->title_ar }} </option>

                @endforeach

            </select>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Floor</span>
            </label>
            <input id="floor"  type="text" class="form-control form-control-solid" placeholder="" name="floor" value="{{ $Room->floor  }} "/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Features</span>
            </label>
            <!--end::Label-->
            <select id="features" name="features[]" class="form-control" fdprocessedid="4rrte">

                <option selected="" disabled=""> choose type</option>
                @foreach($features as $key)
                    <option value="{{ $key->id }}" @if(!empty($Room->features) && in_array($key->id, json_decode($Room->features))) selected @endif  > {{ $key->title_en }} </option>

                @endforeach

            </select>
        </div>
        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Price</span>
            </label>
            <input id="price"  type="text" class="form-control form-control-solid" placeholder="" name="price" value="{{$Room->price}} "/>
        </div>

    </div>
</form>

