<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Book;
use App\EBook;
use App\Http\Middleware\Authenticate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class LandingController extends Controller
{
    public function index()
    {
        $cA = Admin::find(Auth::id());
        $allBooks = Book::all();
        $allEBooks = EBook::all();
        $allUsers = User::all();

        $allBooks = $allBooks->count();
        $allEBooks = $allEBooks->count();
        $allUsers = $allUsers->count();

        return view('landing',['allBooks'=>$allBooks,'allEBooks'=>$allEBooks,'allUsers'=>$allUsers]);
    }
}
