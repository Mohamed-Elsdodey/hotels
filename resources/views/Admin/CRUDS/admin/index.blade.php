@extends('Admin.layouts.inc.app')
@section('title')
    {{trans('admin.admins')}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">{{trans('admin.admins')}}</h5>

                <div>
                    <button id="addBtn" class="btn btn-primary">{{trans('admin.Add a supervisor')}}</button>
                </div>

        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('admin.image')}}</th>
                    <th>{{trans('admin.name')}}</th>
                    <th> {{trans('admin.email')}}</th>
                    <th>Phone</th>
                    <th>{{trans('admin.activation')}}</th>
                    <th>  {{trans('admin.created at')}}</th>
                    <th>{{trans('admin.actions')}}</th>
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
                    <h2><span id="operationType"></span> {{trans('admin.admin')}} </h2>
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
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">{{trans('admin.ok')}}</span>
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
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'is_active', name: 'is_active'},
            {data: 'created_at', name: 'created_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'admins'])
    <!--datatable js-->

    {{--    <script src="{{url('assets')}}/dashboard/js/pages/datatables.init.js"></script>--}}
    {{--    <script>--}}
    {{--        document.addEventListener("DOMContentLoaded", function () {--}}
    {{--            new DataTable("#buttons-datatables", {dom: "Bfrtip", buttons: ["copy", "csv", "excel", "print", "pdf"]})--}}
    {{--        })--}}
    {{--    </script>--}}

    <script>
        $(document).on('change','.activeBtn',function (){
            var id=$(this).attr('data-id');

            $.ajax({
                type: 'GET',
                url: "{{route('admin.active.admin')}}",
                data: {
                    id: id,
                },

                success: function (res) {
                    if (res['status'] == true) {

                        toastr.success("{{trans('admin.operation accomplished successfully')}}")
                        // $('#table').DataTable().ajax.reload(null, false);
                    } else {
                        // location.reload();

                    }
                },
                error: function (data) {
                    // location.reload();
                }
            });


        })
    </script>

@endsection
