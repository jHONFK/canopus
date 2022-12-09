<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Models\Images;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        return response()->json([
            'message' => 'Image uploaded successfully',
            'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
            'class_name' => 'alert-success'
        ]);
    }

}
