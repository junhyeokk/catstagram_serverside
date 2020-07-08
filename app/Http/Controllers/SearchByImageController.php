<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchByImageController extends Controller
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

    public function index()
    {
        return view('search_by_image');
    }

    public function upload()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);

//        return back()
//
//            ->with('success', url('/images').'/'.$imageName)
//
//            ->with('image',$imageName);
        return view('welcome');
    }
}
