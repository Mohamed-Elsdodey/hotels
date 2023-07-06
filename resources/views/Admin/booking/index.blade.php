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
                    <label for="room_feature_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> Room Feature</span>

                    </label>
                    <select class="form-control" id="room_feature_id" name="room_feature_id">
                        <option selected disabled> Choose The Room Feature</option>
                        @foreach($features as $feature)
                            <option value="{{$feature->id}}">@if(app()->getLocale()=='ar')
                                    {{$feature->title_ar??''}}
                                @else
                                    {{$feature->title_en??''}}
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

@endsection
@section('js')

  <script>
        $(document).on('click','#search_btn',function (){
           var  hotel_id=$('#hotel_id').val();
           var  room_category_id=$('#room_category_id').val();
           var  fromDate=$('#fromDate').val();
            var toDate=$('#toDate').val();

            var route="{{route('admin.getRoomsInBooking')}}?hotel_id="+hotel_id+"&&room_category_id="+room_category_id+"&&fromDate="+fromDate+"&&toDate="+toDate;



            setTimeout(function (){
                $('#room_table').load(route)
            },1000)

        })
  </script>

@endsection
