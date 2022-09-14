<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(SliderFormRequest $request)
    {
        $slideValidatedData = $request->validated();
        $slider = new Slider;
        $slider->title = $slideValidatedData['title'];
        $slider->description = $slideValidatedData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('upload/slider', $filename);
            $slider->image = $filename;
        }
        $slider->status = $request->status == true ? '1' : '0';
        $slider->save();
        return redirect(route('admin.sliders'))->with('message', 'Slider Added Successfully');
    }

    public function edit($slider)
    {
        $slider = Slider::query()->findOrFail($slider);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, $slider)
    {
        $validatedData = $request->validated();
        $slider = Slider::query()->findOrFail($slider);
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $path = 'upload/slider/' . $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('upload/slider', $filename);
            $slider->image = $filename;
        }
        $slider->status = $request->status == true ? '1' : '0';
        $slider->update();
        return redirect(route('admin.sliders'))->with('message', 'Slider Updated Successfully');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->count() > 0) {


            $path = 'upload/slider' . $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $slider->delete();
            return redirect(route('admin.sliders'))->with('message', 'This is slider deleted Successfully');
        }
        return redirect(route('admin.sliders'))->with('message', 'Something went wrong');
    }

}
