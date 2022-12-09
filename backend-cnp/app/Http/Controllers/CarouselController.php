<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Images;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return response()->json($carousels);
    }

    public function store(Request $request)
    {
        // $image = $request->file('image');
        $carouselRequest = $request->all();
        $image = $carouselRequest['image'];
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $carousel = new Carousel();
        $carousel->image_path = $new_name;
        $carousel->title = $carouselRequest['title'];
        $carousel->description = $carouselRequest['description'];
        $carousel->save();
        return response()->json([
            'message' => 'Image uploaded successfully',
            'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
            'class_name' => 'alert-success'
        ]);
    }

    public function edit(Request $request){
        $carousel = Carousel::query()->where('id', $request->id)->first();
        $image = $request->image;

        if($image != null){
            //Delete old image
            $pathToDelete = public_path('images/'.$carousel->image_path);
            if(file_exists($pathToDelete)){
                unlink($pathToDelete);
            }

            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $carousel->image_path = $new_name;
        }
        

        
        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->save();

        return response()->json($carousel);
    }

    public function delete(Request $request)
    {
        $carousel = Carousel::query()->where('id', $request->id)->first();
        $carousel->delete();
    }
}
