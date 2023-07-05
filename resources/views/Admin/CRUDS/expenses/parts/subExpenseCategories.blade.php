@if(count($subExpenseCategories)>0)


    <option>Chose Sub Category Now</option>


    @foreach($subExpenseCategories as $category)
        <option value="{{$category->id}}">@if(app()->getLocale()=='ar'){{$category->title_ar}} @else {{$category->title_en}} @endif</option>
    @endforeach


@else


<option>Chose Another Main Category</option>


@endif
