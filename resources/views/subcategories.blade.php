<li><a href="{{route('stores',$category->id)}}">{{$prefix}}{{$category->name}}</a></li>

@if($category->subcategories->isNotEmpty())
    @foreach ($category->subcategories as $alt_cat)
        @include('subcategories',['category' => $alt_cat , 'prefix' => $prefix.'-'])
    @endforeach
@endif