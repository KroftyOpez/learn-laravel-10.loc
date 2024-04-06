<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Метод для отображения всего
    public function index() {
        $products = Product::all();
        if ($products){
            return response()->json($products)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
    //Метод для отображения текущего
    public function show($id){
        $product = Product::find($id);
        if ($product){
            return response()->json($product)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }

    }
    //Метод создания
    public function store(CreateProductRequest $request){
        $product = new Product($request->all());
        $product->save();
        return response()->json($product)->setStatusCode(201);
    }
    //Метод частичного обновления
    public function update(UpdateProductRequest $request, $id){
        $product = Product::find($id);
        if($product){
            $product->update($request->all());
            return response()->json($product)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
    //Метод удаления
    public function destroy($id) {
        $product = Product::find($id);
        if ($product) {
            Product::destroy($id);
            return response()->json()->setStatusCode(204);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
}
