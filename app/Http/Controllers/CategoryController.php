<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Nette\Utils\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mcats = Category::select('mname')->distinct()->get();
        // dd($mcats);
        return view('category.create', compact('mcats'));
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
        $info = $request->validate([
            'mname' => 'required',
            'cname' => 'required',
            'image' => 'image',
            'des' => '',
            'display' => ''
        ]);
        // $image = $request->file('image');

        // // Resize the image
        // $resizedImage = Image::make($image)->resize(150, 150, function ($constraint) {
        //     $constraint->aspectRatio(); // Keep the aspect ratio
        //     $constraint->upsize(); // Prevent upsizing
        // });

        // // Save the resized image to a path (e.g., public folder)
        // $path = public_path('./images/');
        // $resizedImage->save($path);

        if ($request->image) {
            $imagename = time() . "_shop_" . $request->image->getClientOriginalName();
            $request->image->move("./images", $imagename);
            $info['image'] = $imagename;
        }
        Category::create($info);
        return redirect('category')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $mcats = Category::select('mname')->distinct()->get();
        return view('category.edit', ['info' => $category, 'mcats' => $mcats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $info = $request->validate([
            'mname' => 'required',
            'cname' => 'required',
            'image' => 'image',
        ]);
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->image && file_exists(public_path('images/' . $category->image))) {
                unlink(public_path('images/' . $category->image));
            }

            // Upload new image
            $imagename = time() . "_shop_" . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imagename);

            // Store new image name in $info
            $info['image'] = $imagename;
        }
        //Category Update
        $category->update([
            'mname' => $request->mname,
            'cname' => $request->cname,
            'des' => $request->des,
            'display' => $request->display,
            'image' => $info['image'] ?? $category->image, // Keep old image if no new one
        ]);

        return redirect('category')->with('success', 'Data Updated Successfully');
        // if ($request->image) {
        //     if($category->image){
        //         unlink('images/'.$category->image);
        //     }
        //     $imagename = time() . "_shop_" . $request->image->getClientOriginalName();
        //     $request->image->move("./images", $imagename);
        //     $info['image'] = $imagename;
        // }
        // $category->cname=$request->cname;
        // $category->mname=$request->mname;
        // $category->des=$request->des;
        // $category->display = $request->display;
        // $category->save();
        // return redirect('category')->with('success','Data Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function updatedisplay($display, $id)
    {
        $cat = Category::find($id);
        $cat->display = $display;
        $cat->save();
    }
    public function mdel()
    {
        $did = request('delid');
        foreach ($did as $id) {
            $info = Category::find($id);
            if ($info->image && file_exists(public_path('images/' . $info->image))) {
                unlink(public_path('images/' . $info->image));
            }
                $info->delete();
        }
            return redirect('category')->with('delete', 'Data Delete Successfully ');
        }
    }
