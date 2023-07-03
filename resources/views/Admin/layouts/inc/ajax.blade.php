
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable("#example");
    })
</script>

<script>
    var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;
    var newUrl=location.href;


    $(function () {
        console.log(window.location.href)
        $("#table").DataTable({
            processing: true,
            pageLength: 25,
            paging: true,
            dom: 'Bfrltip',


            bLengthChange: true,
            serverSide: true,
            ajax: window.location.href,
            columns: columns,
            "ordering": false,
            // order: [
            //     [0, "ASEC"]
            // ],

            buttons: [
                'colvis',
                'excel',
                'print',
                'copy',
                'csv',

                // 'pdf'
            ],
            lengthMenu: [
                [25, 50, 100, -1],
                [25, 50, 100, 'All'],
            ],

            searching: true,
            destroy: true,
            info: false,
            sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',

            drawCallback: function () {
                $($(".dataTables_wrapper .pagination li:first-of-type"))
                    .find("a")
                    .addClass("prev");
                $($(".dataTables_wrapper .pagination li:last-of-type"))
                    .find("a")
                    .addClass("next");

                $(".dataTables_wrapper .pagination").addClass("pagination-sm");
            }
        });

    });

    $(document).on('click', '#addBtn', function () {
        $('#form-load').html(loader)
        $('#operationType').text('Add');

        $('#Modal').modal('show')

        setTimeout(function (){
            $('#form-load').load("{{route("$url.create")}}")
        },1000)
    });

    $(document).on('submit',"form#form",function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        var url = $('#form').attr('action');
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
    $(document).on('click', '.delete', function () {

        var id = $(this).data('id');
        swal.fire({
            title: "Are you sure to delete?",
            text: "Can't you undo then?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            cancelButtonText: "Cancel",
            okButtonText: "Ok",
            closeOnConfirm: false
        }).then((result) => {
            if (!result.isConfirmed){
                return true;
            }


            var url = '{{ route("$url.destroy",":id") }}';
            url = url.replace(':id',id)
            $.ajax({
                url: url,
                type: 'DELETE',
                beforeSend: function(){
                    $('.loader-ajax').show()

                },
                success: function (data) {

                    window.setTimeout(function() {
                        $('.loader-ajax').hide()
                        if (data.code == 200){
                            toastr.success(data.message)
                            $('#table').DataTable().ajax.reload(null, false);
                        }else {
                            toastr.error('there is an error')
                        }

                    }, 1000);
                }, error: function (data) {

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
                }

            });
        });
    });

    $(document).on('click', '.editBtn', function () {
        var  id = $(this).data('id');
        $('#operationType').text('Edit ');
        $('#form-load').html(loader)
        $('#Modal').modal('show')

        var url = "{{route("$url.edit",':id')}}";
        url = url.replace(':id',id)

        setTimeout(function (){
            $('#form-load').load(url)
        },1000)


    });
</script>
