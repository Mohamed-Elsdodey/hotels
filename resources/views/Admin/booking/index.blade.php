@extends('Admin.layouts.inc.app')
@section('title')
    Booking
@endsection
@section('css')

@endsection
@section('content')


    <form id="data_booking_form" action="{{route('admin.store_booking')}}">
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
                        <span class="required mr-1"> Category Room</span>

                    </label>
                    <select class="form-control" id="room_category" name="category_id">
                        <option selected disabled> Choose Category Room</option>
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
                    <input type="date" class="form-control" id="fromDate" name="from_date">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="toDate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> To Date </span>

                    </label>
                    <input type="date" class="form-control" id="toDate" name="to_date" >
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
                    <input type="number" min="0" class="form-control" name="num_of_adult" id="number_of_adults">
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="number_of_children" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Number Of Children </span>

                    </label>
                    <input type="number" min="0" class="form-control" name="num_of_children" id="number_of_children">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Notes   </span>

                    </label>

                    <textarea class="form-control" id="notes" name="notes"> </textarea>
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Total Before Discount  </span>

                    </label>

                    <input type="number" readonly value="0" min="0" class="form-control" name="total_before_discount" id="total">
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Discount   </span>

                    </label>

                    <input type="number" value="0"   min="0" onkeyup="get_total_afer_discount();" class="form-control" name="discount" id="discount">
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Total After Discount   </span>

                    </label>

                    <input type="number" readonly  min="0" class="form-control" name="total_after_discount" id="total_after_discount">
                </div>


                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Paid   </span>

                    </label>

                    <input type="number" value="0"   min="0" onkeyup="get_total_afer_discount()" class="form-control" name="paid" id="paid">
                </div>

                <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                    <label for="notes" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">  Remain   </span>

                    </label>

                    <input type="number" value="0"  readonly  min="0" onkeyup="" class="form-control" name="remain" id="remain">
                </div>





                <div class="my-4">
                    <button id="search_btn" type="button" class="btn btn-success"> Search</button>
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
            $(`#room_${id}`).val(price);
            var input=`<input type="hidden" class="total" id="input_${id}"  name='rooms[]' value="${id}:${price}">`;
            $('#data_booking_price').append(input);
            $('#Modal').modal('hide');
            var total=0;
            $(".room_price:checked").each(function() {
                //var room_id = $(this).attr('data-id');

                //var split_arr=$('#input_'+room_id).val();
                //var decode_split_arr=  split_arr.split(":");
                //if($(this).is(":checked"))
                //{
              // total = parseFloat(total) + parseFloat(decode_split_arr[1]);
               // }
                var price =$(this).val();
                total = parseFloat(total) + parseFloat(price);

            });
            $('#total').val(total);
            $('#total_after_discount').val(total);
             get_total_afer_discount();

        })
    </script>
    <script>
       function get_total(valu)
       {
           var total= 0 ;
           $(".room_price:checked").each(function() {
               var price =$(this).val();
               total = parseFloat(total) + parseFloat(price);
           });

           $('#total').val(total);
           $('#total_after_discount').val(total);
           get_total_afer_discount();
       }



    </script>

    <script>
        $(document).on('submit',"form#data_booking_form",function (e) {



            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#data_booking_form').attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {


                    $('#submit').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">Work is underway</span>').attr('disabled', true);
                    $('#form-load').append(loader)
                    $('#form').hide()
                },
                complete: function () {
                },
                success: function (data) {

                 //   console.log(data);
                //    return ;



                    window.setTimeout(function () {
                        $('#submit').html('Ok').attr('disabled', false);

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                            $('#Modal').modal('hide')
                            $('#table').DataTable().ajax.reload(null, false);
                        }else {
                            $('#form-load > .linear-background').hide(loader)
                            $('#form').show()
                            toastr.error(data.message)
                        }
                    }, 1000);



                },
                error: function (data) {
                    $('#form-load > .linear-background').hide(loader)
                    $('#submit').html('Ok').attr('disabled', false);
                    $('#form').show()
                    if (data.status === 500) {
                        toastr.error('there is an error')
                    }

                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value)
                                });

                            } else {

                            }
                        });
                    }
                    if (data.status == 421){
                        toastr.error(data.message)
                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });



    </script>

    <script>

        function get_total_afer_discount()
        {
            var total_before_discount =parseFloat($('#total').val());
            var discount =parseFloat($('#discount').val());
            var total_after_discount = total_before_discount - discount ;
            var paid =parseFloat($('#paid').val());
           // alert(total_before_discount);
            //var total_after_discount =parseFloat($('#total_after_discount').val());
            if(total_before_discount < discount){
                $('#discount').val(0);
                $('#total_after_discount').val(total_before_discount);
                return;
            }
           if(total_before_discount != '' || total_before_discount != 0)
           {
             var total_after_discount = total_before_discount - discount ;
             $('#total_after_discount').val(total_after_discount);
           }
           if(total_after_discount !='' || total_before_discount != 0 || paid!='' || paid!=0)
           {
               var remain = total_after_discount - paid ;
               $('#remain').val(remain);
           }


        }


    </script>




@endsection
