<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\product_image;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xdata = Category::where('display', 'yes')->get();
        // dd($xdata);
        $data = [];
        foreach ($xdata as $value) {
            if (count($value->productids) > 0) {
                $key = $value['mname'];
                unset($value['mname']);
                $data[$key][] = $value;
            }
        }
        // dd($data);
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allcats = Category::all(['id', 'cname', 'mname'])->toArray();
        $dt = [];
        foreach ($allcats as $cinfo) {
            $mname = $cinfo['mname'];
            unset($cinfo['mname']);
            $dt[$mname][] = $cinfo;
        }
        // dd($dt);
        return view('product.create', ['catinfo' => $dt]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($_FILES);
        $info = $request->validate([
            'cats' => 'required',
            'name' => 'required',
            'pprice' => 'required|numeric',
            'sprice' => 'required|numeric',
            'discount' => 'numeric',
            'fprice' => 'required|numeric',
            'image.*' => 'image',
            'mimage' => 'image',
            'description' => '',
            'display' => '',
        ]);
        // dd($info);
        $cats = $info['cats'];
        $image = $info['image'];
        $main = $info['mimage'];
        unset($info['image']);
        unset($info['cats']);
        unset($info['mimage']);
        $id = Product::create($info)->id;
        if ($id > 0) {
            foreach ($cats as $cid) {
                $catproinfo = ['product_id' => $id, 'category_id' => $cid];
                ProductCategory::create($catproinfo);
            }
            if ($main) {
                $filename = time() . '_img_' . $main->getClientOriginalName();
                $main->move('./product_images/', $filename);
                $proimage = ['product_id' => $id, 'file_path' => '/product_images/', $filename, 'type' => 'main'];
                product_image::create($proimage);
            }
            foreach ($image as $pimage) {
                if ($pimage) {
                    $fileName = time() . '_image_' . $pimage->getClientOriginalName();
                    $pimage->move('./product_images/', $fileName);
                    $proimage = ['product_id' => $id, 'file_path' => '/product_images/', $fileName];
                    product_image::create($proimage);
                }
            }
        }
        return redirect("/product")->with('success', "Data Saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }
    public function pdisplay($cid)
    {
        $data=Product::whereHas('product_category',function($query)use($cid){
            $query->where('category_id',$cid);
        })->get();
        dd($data);
        return view('product.pdisplay');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
