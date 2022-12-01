<?php

namespace App\Http\Controllers;
use App\Models\ApiModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = ApiModel::latest()->get();
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
        $image_path = $request->file('image')->store('image', 'public');
        
            $post = ApiModel::create([ 
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image_path
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
        $post = ApiModel::whereId($id)->first();

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
        $post = ApiModel::findOrFail($id);

        if($post){
            $post->update([
                'title' =>    $request->title,
                'price' =>  $request->price,
                'category_id' => $request->category_id,
                'image' =>$request->image,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post telah di Update',
                'data' => $post
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Post tidak ditemukn',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=ApiModel::find($id);
        if($product){

            $file = str_replace('\\', '/', public_path('storage/')).$product->image;
            unlink($file);
            $product->delete();

            return response()->json([
                'message' => 'Product berhasil dihapus',
                'code' =>200
            ]);
            return response()->json([
                'message'=>'product dengan id:$id tidak tersedia',
                'code' => 400
            ]);
        }
    }
}
