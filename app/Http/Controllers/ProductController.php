<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function tampilProduk($id)
    {
        $dataku = Product::retrieveByHotelId($id);
        $produkString = '';
        foreach ($dataku as $item) {
            $produkString .= $item->name.', ';
        }
        return response()->json(array(
            'status'=>'oke',
            'msg'=>$produkString
          ),200);
        
    }
}
