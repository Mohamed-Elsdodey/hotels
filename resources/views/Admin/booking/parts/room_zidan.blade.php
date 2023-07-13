<table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
       style="width:100%">
    <thead>
    <tr>
        <th>Floor|Room</th>
        @for($i=1;$i<=$hotel->max_floor_room;$i++)
            <th class="text-center">Room {{$i}} </th>

        @endfor
    </tr>
    </thead>
    <tbody>
    @for($j=1;$j<=$hotel->num_floor;$j++)
        <tr>
            <th>Floor {{$j}}</th>
            @for($k=1;$k<=$hotel->max_floor_room;$k++)
                @php
                    {{$flag=0;}}
                @endphp
                @foreach($rooms as $room)
                    @if($room->floor==$j && $room->room_number==$k)
                        <th class="text-center">{{$room->floor}}{{$room->room_number}} <input data-price="{{$room->price}}" class="room_price" data-id="{{$room->id}}" type="checkbox"></th>
                        @php
                            {{$flag=1;}}
                        @endphp
                    @endif
                @endforeach
                @if($flag==0)
                    <th class="text-center">--</th>
                @endif
            @endfor
        </tr>
    @endfor
</table>

<button type="submit" form="data_booking_form" class="btn btn-success"> save</button>

