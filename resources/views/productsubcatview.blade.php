<li data-toggle="collapse" data-target="#collapseOne">
    <button type="submit" name="category_id" value="{{$productcategory->id}}">{{$space}} {{$productcategory->name}}</button>
</li>

@if(!empty($productcategory->subcategory))
    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
        <div class="card-body">
            <ul>
                @foreach ($productcategory->subcategory as $sub_cat)
                    @include('productsubcatview', ['productcategory' => $sub_cat, 'space' => $space . '-'])
                @endforeach
            </ul>
        </div>
    </div>
@endif