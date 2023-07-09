@extends('Admin.layouts.inc.app')
@section('title')
    Booking
@endsection
@section('css')

@endsection
@section('content')
    <div class="card">
        <div class="card-header ">
            <h5 class="card-title mb-0 flex-grow-1">Booking</h5>

            <div class="row g-4">

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="hotel_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> Hotels</span>

                    </label>

                    <select class="form-control" id="hotel_id" name="hotel_id">
                        <option selected disabled> Choose The Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{$hotel->id}}">{{$hotel->name??''}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="room_category" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> Room Feature</span>

                    </label>
                    <select class="form-control" id="room_category" name="room_category">
                        <option selected disabled> Choose The Room Feature</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">@if(app()->getLocale()=='ar')
                                    {{$category->title_ar??''}}
                                @else
                                    {{$category->title_en??''}}
                                @endif</option>
                        @endforeach
                    </select>
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="fromDate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> From Date </span>

                    </label>
                    <input type="date" class="form-control" id="fromDate">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="toDate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> To Date </span>

                    </label>
                    <input type="date" class="form-control" id="toDate">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="client_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> Client  </span>

                    </label>
                    <select class="form-control" id="client_id" name="client_id">
                        <option selected disabled> Choose The Client</option>
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="number_of_adults" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Number Of Adults </span>

                    </label>
                    <input type="number" min="0" class="form-control" id="number_of_adults">
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="number_of_children" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Number Of Children </span>

                    </label>
                    <input type="number" min="0" class="form-control" id="number_of_children">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Notes   </span>

                    </label>
                    <input type="text" class="form-control" id="notes">
                </div>


                <div class="my-4">
                    <button id="search_btn" class="btn btn-success"> Search</button>
                </div>


            </div>

        </div>


        <div class="card-body" id="room_table">


        </div>


    </div>



    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2><span id="operationType"></span> Room Price </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer"
                         data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-3">
                            {{trans('admin.cancel')}}
                        </button>
                        <button form="form" type="button" id="save_price" class="btn btn-primary">
                            <span class="indicator-label">{{trans('admin.ok')}}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


    <form id="data_booking_form" action="{{route('admin.store_booking')}}">
        <div id="data_booking_price">

        </div>
    </form>




@endsection
@section('js')

    <script>
        var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;

    </script>
    <script>
        $(document).on('click', '#search_btn', function () {
            var hotel_id = $('#hotel_id').val();
            var room_category = $('#room_category').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();

            var route = "{{route('admin.getRoomsInBooking')}}?hotel_id=" + hotel_id + "&&room_category=" + room_category + "&&fromDate=" + fromDate + "&&toDate=" + toDate;

            $('#data_booking_price').html('');

            setTimeout(function () {
                $('#room_table').load(route)
            }, 1000)

        })
    </script>


    <script>
        $(document).on('change', '.room_price', function () {
            var id=$(this).attr('data-id');
            var price = $(this).attr('data-price');
            var checked = $(this).is(':checked');
            if (checked) {
                $('#form-load').html(loader)
                $('#Modal').modal('show')
                $(`#input_${id}`).remove();
                var input=`<input type="hidden" id="input_${id}"  name='rooms[]' value="${id}:${price}">`;
                $('#data_booking_price').append(input);
                var route_price="{{route('admin.getRoomPrice',':id')}}";
                route_price=route_price.replace(':id',id)
                setTimeout(function (){
                    $('#form-load').load(route_price)
                },1000)
            }
            else{
                $(`#input_${id}`).remove();
            }

        })
    </script>

    <script>
        $(document).on('click','#save_price',function (){
            var id=$('#room_price').attr('data-id');
            var price=$('#room_price').val();

            $(`#input_${id}`).remove();
            var input=`<input type="hidden" id="input_${id}"  name='rooms[]' value="${id}:${price}">`;
            $('#data_booking_price').append(input);
            $('#Modal').modal('hide')


        })
    </script>

@endsection
