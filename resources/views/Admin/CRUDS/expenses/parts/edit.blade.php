<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('expenses.update',$row->id)}}">

    @csrf
    @method('PUT')
    <div class="row g-4">




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title_ar" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title In Arabic</span>
            </label>
            <!--end::Label-->
            <input id="title_ar"  type="text" class="form-control form-control-solid" placeholder="" name="title_ar" value="{{$row->title_ar}}"/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title_en" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title In English</span>
            </label>
            <!--end::Label-->
            <input id="title_en"  type="text" class="form-control form-control-solid" placeholder="" name="title_en" value="{{$row->title_en}}"/>
        </div>




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="main_expense_category_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Main Category</span>
            </label>
            <!--end::Label-->

            <select id="main_expense_category_id" name="main_expense_category_id"  class="form-control" >

                <option selected disabled> chose  Category</option>
                @foreach($expenseCategories as $category)

                    <option @if($row->main_expense_category_id==$category->id)  selected   @endif value="{{$category->id}}">@if(app()->getLocale()=='ar'){{$category->title_ar}} @else {{$category->title_en}} @endif</option>

                @endforeach

            </select>

        </div>




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="sub_expense_category_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Sub Category</span>
            </label>
            <!--end::Label-->

            <select id="sub_expense_category_id" name="sub_expense_category_id"  class="form-control" >

                @foreach($subExpenseCategories as $category)

                    <option @if($row->sub_expense_category_id ==$category->id)  selected   @endif value="{{$category->id}}">@if(app()->getLocale()=='ar'){{$category->title_ar}} @else {{$category->title_en}} @endif</option>

                @endforeach
            </select>

        </div>







        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="value" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Value  </span>
            </label>
            <!--end::Label-->
            <input id="value"  type="number" class="form-control form-control-solid" placeholder="" name="value" value="{{$row->value}}"/>
        </div>





    </div>
</form>

