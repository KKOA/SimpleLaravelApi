<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    //
    public function index(){
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request){
        $book = new Books();
        $book->name = $request->name;
        $book->author= $request->author;
        $book->published_date = $request->published_date;
        $book->save();

        return response()->json([
            "message" => "Booked Added.",
        ],201);
    }

    public function show($id){
        $book = Books::find($id);
        if(empty($book)){
            return response()->json([
                "message" => "Book not found"
            ],404);
        }
        return response()->json($book);
    }

    public function update(Request $request, $id){
       if(!Books::where('id',$id)->exists()){
		return response()->json([
			"message" => "Book not found"
		],404);
       }
       $book = Books::find($id);
	   $book->name = $request->name ?? $book->name;
	   $book->author=  $request->author ?? $book->author; 
	   $book->published_date = $request->published_date ?? $book->published_date;
	   $book->save();

	   return response()->json([
			"message" => "Book Updated"
		],204);

    }

	public function destroy($id){
		if(!Books::where('id',$id)->exists()){
			return response()->json([
				"message" => "Book not found"
			],404);
		}

		$book = Books::find($id);
		$deletedBookName = $book->name;
		$book->delete();

		return response()->json([
			"message" => "$$deletedBookName  book deleted"
		],202);
	}


}
