<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoresAddRequest;
use App\Models\Category;
use App\Models\Stores;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function Stores(Category $category){
        $categories = $category->getAllSubCategories($category);
        $stores = Stores::whereIn( 'category_id',$categories)->get();
        return view('site.pages.stores.storeslist',compact('stores','category'));
    }

    public function StoresShow(){
        $categories = Category::where('cat_ust', 0)->with('subcategories')->get();
        return view('site.pages.stores.storesadd',compact( 'categories'));
    }

    public function StoresCreate(StoresAddRequest $request){

        $data = $request->validated();

        try {
            $logo = $request->file('logo');
            $logoname = time().'.'.$data['logo']->getClientOriginalExtension();
            $logo->move(public_path('logos'),$logoname);
        }catch(\Exception $e){
            report($e);
            return back()->with('error','Resim dosyası yüklenirken beklenmedik bir hata oluştu. Hata mesajı: ' . $e->getMessage());
        }

        Stores::create([
            'user_id' => Auth::user()->id,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'logo' => $logoname ?? null,
            'status' => 'off',
        ]);

        return back()->withSuccess('Mağazanız Başarılı Bir Şekilde Oluşturulmuştur');
    }

    public function StoresEdit(Stores $store){
        return view('site.pages.stores.storesupdate',compact('store'));
    }

    public function StoresUpdate(StoresAddRequest $request,Stores $store){

        $data = $request->validated();

        try {
            $logo = $request->file('logo');
            $logoname = time().'.'.$request->logo->getClientOriginalExtension();
            $logo->move(public_path('logos'),$logoname);
        }catch(\Exception $e){
            report($e);
            return back()->with('error','Resim dosyası yüklenirken beklenmedik bir hata oluştu. Hata mesajı: ' . $e->getMessage());
        }

        $store->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'logo' => $logoname ?? null,
        ]);

        return back()->withSuccess('Güncelleme İşleminiz Başarılı');
    }

    public function UserStores(User $user){
        return view('site.pages.stores.userstores',compact('user'));
    }
}
