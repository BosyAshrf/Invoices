<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.index',compact('sections'));
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
            'section_name' => 'required|unique:sections,section_name|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u|max:255',
        ],[
            "section_name.required"=>'يرجى ادخال اسم القسم',
            "section_name.unique"=>'اسم القسم ماخوذ مسبقا',
            "section_name.regex"=>'اسم القسم غير لائق',
            "section_name.max"=>'اسم القسم تخطي العدد',
        ]
    );
        sections::create([
            'section_name' =>$request->section_name,
            'description' =>$request->description,
            'created_by' =>(Auth::user()->name),
         ]);

            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'section_name' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u|max:255',
        ],[
            "section_name.required"=>'يرجى ادخال اسم القسم',
            "section_name.regex"=>'اسم القسم غير لائق',
            "section_name.max"=>'اسم القسم تخطي العدد',
        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' =>$request->section_name,
            'description' =>$request->description,
            'created_by' =>(Auth::user()->name),
         ]);

            session()->flash('edit', 'تم تعديل القسم بنجاح ');
            return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sections = sections::find($id)->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح ');
        return redirect('/sections');
    }
}

