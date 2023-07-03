
<!-- JAVASCRIPT -->
<script src="{{url('assets')}}/dashboard/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('assets')}}/dashboard/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('assets')}}/dashboard/libs/node-waves/waves.min.js"></script>
<script src="{{url('assets')}}/dashboard/libs/feather-icons/feather.min.js"></script>
<script src="{{url('assets')}}/dashboard/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="{{url('assets')}}/dashboard/js/plugins.js"></script>
<script src="{{url('assets')}}/dashboard/js/jquery.fancybox.min.js"></script>

<!-- apexcharts -->
{{--<script src="{{url('assets')}}/dashboard/libs/apexcharts/apexcharts.min.js"></script>--}}

<!-- Vector map-->
{{--<script src="{{url('assets')}}/dashboard/libs/jsvectormap/js/jsvectormap.min.js"></script>--}}
{{--<script src="{{url('assets')}}/dashboard/libs/jsvectormap/maps/world-merc.js"></script>--}}

<!--Swiper slider js-->
{{--<script src="{{url('assets')}}/dashboard/libs/swiper/swiper-bundle.min.js"></script>--}}

<!-- Dashboard init -->
{{--<script src="{{url('assets')}}/dashboard/js/pages/dashboard-ecommerce.init.js"></script>--}}


<!-- App js -->
<script src="{{url('assets')}}/dashboard/js/app.js"></script>
<script src="{{url('assets')}}/dashboard/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{url('assets')}}/dashboard/js/pages/sweetalerts.init.js"></script>
<script src="{{url('assets')}}/dashboard/libs/apexcharts/apexcharts.min.js"></script>


<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
</script>


<script>
    $('.lds-hourglass').fadeOut(1000)
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $(document).on('keyup','.numbersOnly',function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
</script>

<script>
    $(document).on('click','.activatedPerson',function (e){
        e.preventDefault();
        var url=$(this).attr('href');
        url=url+"?is_active=1";
        window.location=url;
    })



</script>




@yield('js')
