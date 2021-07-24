<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use Exception;

class ShoeController extends Controller
{
    public function show(Shoe $shoe) {
        return response()->json($shoe,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $shoes = Shoe::where('title','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($shoes, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'brand' => 'string|required',
            'size' => 'numeric|required',
            'price' => 'numeric|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $shoe = Shoe::create($request->all());
            return response()->json($shoe, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Shoe $shoe) {
        try {
            $shoe->update($request->all());
            return response()->json($shoe, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Shoe $shoe) {
        $shoe->delete();
        return response()->json(['message'=>'Shoe deleted.'],202);
    }

    public function index() {
        $shoes = Shoe::orderBy('name')->get();
        return response()->json($shoes, 200);
    }
}
