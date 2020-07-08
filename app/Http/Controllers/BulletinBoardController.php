<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class BulletinBoardController extends Controller
{
    public function index(Request $request) {
//        $cat_id = $request->input('cat_id');
//        $rows = Article::where('cat_id', '=', $cat_id)->paginate(5);
//
//        Log::info($cat_id);
//        return view('bulletin_board', [
//            'rows' => $rows
//        ]);
    }
}
