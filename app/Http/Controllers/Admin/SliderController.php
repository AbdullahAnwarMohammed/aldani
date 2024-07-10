<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as InterventionImage;

class SliderController extends Controller
{
    public function index()
    {
        $Sliders = Slider::orderBy('created_at', 'desc')->paginate(4);
        $AllSlider = Slider::count();

        return view("admin.slider.index",compact('Sliders','AllSlider'));
    }
    public function store(Request $request){
        
            $request->validate([
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($request->hasfile('file')) {
                foreach ($request->file('file') as $image) {
                    $imageName = time().'_'.$image->getClientOriginalName();


                    $imageInv = InterventionImage::make($image);
                    $imageInv->resize(357 , 200, function ($constraint) {
                        // $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    // Save the image to the storage
                    $imageInv->save(public_path('uploads/slider/resize/' . $imageName));
                    $image->move(public_path('uploads/slider'), $imageName);


                    Slider::create([
                        'photo' => $imageName
                    ]);
                }
            }

            return redirect()->back()->with('success','تم رفع الصور بنجاح');
    }

    public function destory($id)
    {
        $Slider = Slider::where('id',$id)->first();
        if (File::exists(public_path('uploads/slider/' . $Slider->photo))) {
            File::delete(public_path('uploads/slider/' . $Slider->photo));
        }
        if (File::exists(public_path('uploads/slider/resize/' . $Slider->photo))) {
            File::delete(public_path('uploads/slider/resize/' . $Slider->photo));
        }
        Slider::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم الحذف بنجاح');


    }
}
