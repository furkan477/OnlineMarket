<option value="{{$category->id}}">{{$prefix}} {{$category->name}}</option>

@if($category->subcategories->isNotEmpty())
    @foreach ($category->subcategories as $alt_cat)
        @include('subcategoriesoption',['category' => $alt_cat , 'prefix' => $prefix.'-'])
    @endforeach
@endif