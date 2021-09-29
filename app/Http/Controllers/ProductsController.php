<?php

namespace App\Http\Controllers;

use App\products;
use App\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $products = products::all();
        return view('products.index', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products,product_name|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u|max:255',
            'section_id' => 'required',
        ], [
            "product_name.required" => 'يرجى ادخال اسم المنتج',
            "product_name.unique" => 'اسم المنتج ماخوذ مسبقا',
            "product_name.regex" => 'اسم المنتج غير لائق',
            "product_name.max" => 'اسم المنتج تخطي العدد',
            "section_id.required" => 'يرجى ادخال اسم القسم',
        ]);
        products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,

        ]);

        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nots = $request->note;
        $products = products::find($id);

        if (!$nots == 2) {
            $this->validate($request, [
                'product_name' => 'required|unique:products,product_name|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u|max:255',
                'section_id' => 'required',
            ], [
                "product_name.required" => 'يرجى ادخال اسم المنتج',
                "product_name.unique" => 'اسم المنتج ماخوذ مسبقا',
                "product_name.regex" => 'اسم المنتج غير لائق',
                "product_name.max" => 'اسم المنتج تخطي العدد',
                "section_id.required" => 'يرجى ادخال اسم القسم',

            ]);
            $products->update([
                'product_name' => $request->product_name,
                'section_id' => $request->section_id,
                'description' => $request->description,
            ]);
        } else {

            $products->update([
                'description' => $request->description,
            ]);
        }




        session()->flash('Edit', 'تم تعديل المنتج بنجاح ');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = products::findOrfail($id)->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح ');
        return redirect('/products');
    }
}
