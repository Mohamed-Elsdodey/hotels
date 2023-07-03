@extends('Admin.layouts.inc.app')
@section('title')
    General Settings
@endsection
@section('css')

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />

@endsection

{{--@section('page-title')--}}
{{--    General Settings--}}
{{--@endsection--}}



@section('content')

    <div class="card">
        <div class="card-header ">
            <h5 class="card-title mb-0 flex-grow-1">General Settings</h5>


            <form id="form" enctype="multipart/form-data" method="POST" action="{{route('settings.store')}}">
                @csrf
                <div class="row my-4 g-4">

                            <div class="d-flex flex-column mb-7 fv-row col-sm-12">
                                <!--begin::Label-->
                                <label for="app_name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1"> Web site name</span>
                                </label>
                                <!--end::Label-->
                                <input id="app_name"  type="text" class="form-control form-control-solid" name="app_name"
                                       value="{{$settings->app_name}}"/>
                            </div>




                        <div class="form-group">
                            <label for="name" class="form-control-label fs-6 fw-bold ">  logo </label>
                            <input type="file" class="dropify" name="logo_header"
                                   data-default-file="{{get_file($settings->logo_header)}}"
                                   accept="image/*"/>
                            <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                        </div>





                        <div class="form-group">
                            <label for="name" class="form-control-label fs-6 fw-bold ">  Elvive Icon </label>
                            <input type="file" class="dropify" name="fave_icon"
                                   data-default-file="{{get_file($settings->fave_icon)}}"
                                   accept="image/*"/>
                            <span class="form-text text-muted text-center">Only the following formats are allowed: jpeg, jpg, png, gif, svg, webp, avif.</span>
                        </div>


{{--                    @can('التعديل علي الاعدادات العامة')--}}

                        <div class="my-4">
                            <button type="submit" class="btn btn-success"> Edit</button>
                        </div>

{{--                    @endcan--}}

                </div>
            </form>

        </div>
    </div>


@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


    <script>
        $('.dropify').dropify();

    </script>


    <script>
        // CKEDITOR.replace('privacy');



    </script>
    <script>
        $(document).on('submit', "form#form", function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,

                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                        } else {
                            toastr.error(data.message)
                        }
                    }, 1000);


                },
                error: function (data) {
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
                    if (data.status == 421) {
                        toastr.error(data.message)
                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

@endsection
