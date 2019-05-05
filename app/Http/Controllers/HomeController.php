<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images = Image::all();
        $products = Product::all();

        return view('home', compact('images', 'products'));
    }
    public function image(Request $request)
    {
        $attributes = request()->validate([
            'image' => ['required', 'image']
        ]);
        
        if($request->hasFile('image')) 
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/uploads', $fileNameToStore);

            $data = file_get_contents($request->file('image'));
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        $attributes['image'] = $fileNameToStore;
        $attributes['image_base'] = $base64;

        Image::create($attributes);

        return redirect('/');
    }
}
