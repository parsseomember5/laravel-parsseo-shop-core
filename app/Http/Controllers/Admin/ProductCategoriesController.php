<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class ProductCategoriesController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::latest()->paginate(20);
        return view('admin.views.product_categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.views.product_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif'
        ]);
        $inputs = $request->all();

        // generate slug from user input
        if ($request->has('slug') && !empty($request->slug)){
            $inputs['slug'] = SlugService::createSlug(ProductCategory::class, 'slug', $request->slug);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $inputs['image'] = $this->uploadRealFile($image,'product-categories');
        }

        $inputs['featured'] = false;
        if ($request->has('featured') && $request->featured == 'on') {
            $inputs['featured'] = true;
        }

        ProductCategory::create($inputs);

        session()->flash('success','دسته بندی با موفقیت ایجاد شد.');
        return redirect(route('product-categories.index'));
    }


    public function edit(ProductCategory $productCategory)
    {
        return view('admin.views.product_categories.edit',compact('productCategory'));
    }


    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:350',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif'
        ]);

        // update slug
        if ($request->slug != $productCategory->slug){
            $inputs['slug'] = SlugService::createSlug(ProductCategory::class, 'slug', str_replace('/','',$request->slug));
        }

        $inputs = $request->all();

        if ($request->remove_image != null) {
            $fileUrl = request('remove_image');
            $this->removeStorageFile($fileUrl);
            $inputs['image'] = null;
        }

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $inputs['image'] = $this->uploadRealFile($image,'product-category');
        }

        $inputs['featured'] = false;
        if ($request->has('featured') && $request->featured == 'on') {
            $inputs['featured'] = true;
        }

        $productCategory->update($inputs);

        session()->flash('success','تغییرات با موفقیت ذخیره شد.');
        return redirect(route('product-categories.index'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        $name = $productCategory->title;
        $this->removeStorageFile($productCategory->image);
        $productCategory->delete();
        session()->flash('success','دسته بندی ('.$name.') با موفقیت حذف شد');
        return redirect(route('product-categories.index'));
    }

    public function search(){
        $query = request('query');
        $categories = Search::add(ProductCategory::class,'title')
            ->dontParseTerm()
            ->beginWithWildcard()
            ->paginate(20)->search($query);
        $categories->appends(array('query' => $query))->links();
        return view('admin.views.product_categories.index',compact('categories','query'));
    }
}
