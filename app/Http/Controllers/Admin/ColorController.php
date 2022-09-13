<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorFormRequest $request)
    {
        $color = $request->validated();
        $colors=Color::query()->create([
            'name'=>$color['name'],
            'code'=>$color['code'],
            'status'=>$request->status == true ?'1' : '0',
        ]);
        $colors->save();
        return redirect('admin/colors')->with('message','Colors Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(ColorFormRequest $request, Color $color)
    {
        $validatedData = $request->validated();
        $colors = Color::query()->findOrFail($color->id);
        $colors->update([
            'name'=>$validatedData['name'],
            'code'=>$validatedData['code'],
            'status'=>$request->status == true? '1':'0',
        ]);
        return redirect('admin/colors')->with('message', 'Color Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color = Color::query()->find($color['id']);
        $color->delete();
        return redirect('admin/colors')->with('message','Colors Deleted Successfully');
    }
}
