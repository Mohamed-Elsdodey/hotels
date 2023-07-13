@extends('Admin.layouts.inc.app')
@section('title')
    الفنادق
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1"> Hotels</h5>

            <div>
                <a href="{{ route('booking.create')  }}"> <button id="" class="btn btn-primary">Add Hotels </button> </a>

            </div>



        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Hotel </th>
                    <th> Room Category</th>
                    <th>From date</th>
                    <th>To date</th>
                   <th>Num days</th>
       <th>Total before Discount</th>
 <th> Discount</th>
<th>Total after Discount</th>
                    <th> created date</th>
                    <th> actions </th>
                </tr>
                </thead>
            </table>
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
                    <h2><span id="operationType"></span> hotel </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <button class="btn btn-sm btn-icon btn-active-color-primary" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-tmes"></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body py-4" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-2">
                            cancel
                        </button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">save</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'hotel', name: 'hotel'},
            {data: 'category', name: 'category'},
            {data: 'from_date', name: 'from_date'},
            {data: 'to_date', name: 'to_date'},
            {data: 'num_days', name: 'num_days'},
            {data: 'total_before_discount', name: 'total_before_discount'},
            {data: 'discount', name: 'discount'},
            {data: 'total_after_discount', name: 'total_after_discount'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>

    @include('Admin.layouts.inc.ajax',['url'=>'hotels'])

    <script src="{{url('assets')}}/dashboard/js/alert.js"></script>
    <script>

        function check2(row_id)
        {


            Swal.fire({
                title: 'Are you sure?',
                text: "Posting the bill to the Egyptian taxes",

                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Posting it!'
            }).then((result) => {
                if (result.isConfirmed) {
                   $.ajax({
                        url: '{{route('booking.store')}}',
                        type: 'POST',
                       data: { id: row_id },
                        beforeSend: function () {


                            $('#edit'+row_id).html('<span class="spinner-border spinner-border-sm mr-2" ' +
                                ' ></span> <span style="margin-left: 4px;">Work is underway</span>').attr('disabled', true);
                           // $('#form-load').append(loader)
                           // $('#form').hide()
                        },
                        complete: function () {
                        },
                        success: function (data) {

alert("ddd");




                        },
                        error: function (data) {

                            alert("ff");
                        },//end error method


                    });



                    Swal.fire(
                        'Posted!',
                        'Your bill has been Posted.',
                        'success'
                    )
                }
            })
        }

    </script>

@endsection
