<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($p){
                return [
                    "name" => $p->name,
                    'totalPrice' => round((1-($p->discount/100)) * $p->price,2),
                    'rating' => $p->reviews->count() > 0  ? round($p->reviews->sum('star')/$p->reviews->count(),2): 'No rating yet',
                    "href" => [
                        "link" => route('products.show',$p->id)
                    ]
                ];
            }),
        ];
        
    }
}
