<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use function Symfony\Component\Console\Style\success;

class CategoryController extends Controller
{
    private $validator;
    private $categories;
    public function index()
    {
        $this->categories = Category::latest()->paginate(5);
        return response()->json([
            'status'    => true,
            'data'      => $this->categories
        ],Response::HTTP_ACCEPTED);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /*$this->validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);
        if($this->validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $this->validator->errors()
            ],Response::HTTP_BAD_REQUEST);
        }*/
        $request->validate([
            'name' => 'required'
        ]);
        Category::newCategory($request);
        return response()->json([
            'status' => true,
            'message' => 'Category created successfully.'
        ],Response::HTTP_CREATED);
    }



    public function edit(Category $category)
    {
        if($category){
            return response()->json([
                'status'=> true,
                'data'  => $category,
            ],Response::HTTP_ACCEPTED);
        }
        return response()->json('Not found',Response::HTTP_BAD_REQUEST);

    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
        ]);
        Category::updateCategory($request,$category);
        return response()->json([
            'status' => true,
            'message' => 'Category update successfully.'
        ],Response::HTTP_CREATED);
    }


    public function destroy(Category $category)
    {
        Category::deleteCategory($category->id);
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully.'
        ],Response::HTTP_ACCEPTED);
    }
}
