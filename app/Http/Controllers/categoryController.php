<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Category::latest()->get();
        return response([
            'success' => true,
            'message' => 'List semua Post',
            'data' => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_path = $request->file('category_image')->store('image', 'public');
        $post = Category::create([ 
        'category_name' => $request->category_name,
        'category_image' => $image_path
    ]);

    if ($post){
        return response()->json([
            'success' => true,
            'message' => 'Post Berhasil di Simpan',
        ], 200);
    }else {
        return response()->json([
            'success' => false,
            'message' => 'Post Gagal Disimpan!!',
        ], 400);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Category::whereId($id)->get()->load(['apiModel']);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data' => $post
            ], 200); 
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Post tidak di Temukan',
                'data' => ''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
