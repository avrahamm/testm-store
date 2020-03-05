<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->image_url = $request->input('image_url');
        $product->save();

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->has('name')) {
            $product->name = $request->input('name');
        }
        if ($request->has('description')) {
            $product->description = $request->input('description');
        }
        if ($request->has('price')) {
            $product->price = $request->input('price');
        }
        if ($request->has('image_url')) {
            $product->image_url = $request->input('image_url');
        }
        $product->save();

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return new JsonResponse(['status' => 'success', 'msg' => 'Deleted Successfully']);
        }

        throw new \Exception('Product does not exist');
    }
}
