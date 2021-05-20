<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload image
        $image = $request->image->store('products');

        // check status
        !empty($request->status) ? $status = $request->status : $status = 0;

        Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image,
            'status' => $status,
            'category_id' => $request->category
        ]);

        return response(Product::all(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(is_null($product)) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        return response()->json($product::find($id), 200);
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
        $product = Product::find($id);

        if(is_null($product)) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        
        $data = $request->only(['title', 'description', 'price', 'status', 'category_id']);

        if($request->hasFile('image'))
        {
            $image = $request->image->store('products');

            Storage::delete($product->image);

            $data['image'] = $image;
        }

        $product->update($data);
        
        return response($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(is_null($product)) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }
}
