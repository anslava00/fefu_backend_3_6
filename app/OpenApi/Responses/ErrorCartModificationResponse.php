<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\ErrorCartModificationSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorCartModificationResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unprocessableEntity()->description('Invalid response')->content(
            MediaType::json()->schema(ErrorCartModificationSchema::ref()));
    }
}