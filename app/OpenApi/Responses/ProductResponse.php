<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\ProductAttributeValueSchema;
use App\OpenApi\Schemas\ProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema as ObjectsSchema;

class ProductResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')->content(
            MediaType::json()->schema(
                ObjectsSchema::object()->properties(
                    ObjectsSchema::array('data')->items(ProductSchema::ref()),
                )
            )
        );
    }
}
