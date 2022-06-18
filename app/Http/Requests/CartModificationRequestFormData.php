<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;
use Vyuldashev\LaravelOpenApi\Attributes\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use Illuminate\Support\Facades\Schema;

class CartModificationRequestFormData extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->required()
            ->description('Cart modification')
            ->content(MediaType::json()->schema(
                Schema::object()->properties(
                    Schema::array('modifications')->items(
                        Schema::object()->properties(
                            Schema::integer('product_id'),
                            Schema::integer('quantity')
                        )
                    )
                )
            ));
    }
}
