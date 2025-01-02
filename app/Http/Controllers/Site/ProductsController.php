<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Stores;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function ProductsList(Stores $store, Request $request)
    {
        if (!empty($request->category_id)) {
            $category = Category::where('id',$request->category_id)->first();
            $categories = $category->getAllSubCategories($category);
            $products = Product::where('store_id', $store->id)->whereIn('category_id', $categories)->get();
        } else {
            $products = Product::where('store_id', $store->id)->get();
        }

        $productcategories = ProductCategory::where('cat_ust', 0)->with('subcategory')->get();
        return view('site.pages.products.productslist', compact('products', 'store', 'productcategories'));
    }

    public function ProductsCreate(Stores $store, ProductRequest $request)
    {

        $data = $request->validated();

        try {
            $image = $request->file('image');
            $imagename = time() . '.' . $data['image']->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Resim dosyası yüklenirken beklenmedik bir hata oluştu. Hata mesajı: ' . $e->getMessage());
        }

        $store->products()->create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image' => $imagename ?? null,
        ]);

        return back()->withSuccess('Ürününüz Başarılı Bir Şekilde Oluşturulmuştur.');
    }

    public function ProductsDetail(Product $product)
    {
        return view('site.pages.products.productsdetail', compact('product'));
    }
}
