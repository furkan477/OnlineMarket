<option value="{{$productcategory->id}}">{{$space}} {{$productcategory->name}}</option>

@if(!empty($productcategory->subcategory))
    @foreach ($productcategory->subcategory as $sub_cat)
        @include('productsubcat',['productcategory' => $sub_cat , 'space' => $space.'-'])
    @endforeach
@endif