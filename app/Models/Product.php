<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;
    private static $product;
    private static $imageName;
    private static $imageUrl;
    private static $directory;
    private static $extension;
    private static function imageUpload($image)
    {
        self::$extension = $image->getClientOriginalExtension();
        self::$imageName =  time().'_'.rand(100,9999).'.'.self::$extension;
        self::$directory = 'product_images/';
        $image->move(self::$directory,self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }
    public static function addNewProduct($request)
    {
        self::$product              = new Product();
        self::$product->name        = $request->name;
        self::$product->slug        = Str::slug($request->name);
        self::$product->price       = $request->price;
        self::$product->image       = self::imageUpload($request->file('image'));
        self::$product->description = $request->description;
        self::$product->save();
    }

}
