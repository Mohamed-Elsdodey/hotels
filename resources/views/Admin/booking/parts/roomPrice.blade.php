
<div class="row g-4">


    <div class="d-flex flex-column mb-7 fv-row col-sm-12">
        <!--begin::Label-->
        <label for="room_price" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required mr-1">Booking Room Price </span>
        </label>
        <!--end::Label-->
        <input id="room_price" required type="number" class="form-control form-control-solid" placeholder="" name="room_price" data-id="{{$room->id}}" value="{{$room->price}}"/>
    </div>



</div>
