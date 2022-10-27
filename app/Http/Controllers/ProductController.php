<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProudctResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $products;
    private $product;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->products = Product::latest()->get();
        return ProudctResource::collection($this->products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       =>'required',
            'price'      =>'required',
            'description'=>'required',
        ]);
        try {
            Product::addNewProduct($request);
            return response()->json([
                'status' => true,
                'message' => 'Product created successfully'
            ],Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'error' => $th->getMessage()
            ],Response::HTTP_NOT_ACCEPTABLE);
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
        //
    }


    public function edit($id)
    {
        $this->product = Product::find($id);
        return response()->json([
            'status' => true,
            'data' => $this->product
        ],Response::HTTP_ACCEPTED);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name'       =>'required',
            'price'      =>'required',
            'description'=>'required',
        ]);
        Product::updateProduct($request,$id);
        return response()->json([
            'status' => true,
            'message' => 'Product update successfully'
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::deleteProduct($id);
        return response()->json([
            'status' => true,
            'message'  => 'Product deleted successfully.'
        ],Response::HTTP_ACCEPTED);
    }
}
