@extends('Admin.layouts.inc.app')
@section('title')
    Expenses
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1"> Expenses   </h5>

            <div>
                <button id="addBtn" class="btn btn-primary">Add Expense  </button>
            </div>



        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>  Title </th>
                    <th>  Main Category </th>
                    <th>  Sub Category </th>
                    <th> Value </th>
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
                    <h2><span id="operationType"></span>  Expense </h2>
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
            @if(app()->getLocale()=='ar')
            {data: 'title_ar', name: 'title_ar'},
            @else
            {data: 'title_en', name: 'title_en'},
            @endif
            {data: 'main_expense_category_id', name: 'main_expense_category_id'},
            {data: 'sub_expense_category_id', name: 'sub_expense_category_id'},
            {data: 'value', name: 'value'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>

    @include('Admin.layouts.inc.ajax',['url'=>'expenses'])

    <script>
        $(document).on('change','#main_expense_category_id',function () {
            var from_id=$(this).val();

            var route="{{route('admin.getSubExpenseCategoryByMain',':id')}}"
                route=route.replace(':id',from_id);
            setTimeout(function (){
                $('#sub_expense_category_id').load(route)
            },1000)
        })
    </script>


@endsection