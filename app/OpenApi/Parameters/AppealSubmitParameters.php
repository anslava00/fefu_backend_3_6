<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class AppealSubmitParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('name')
                ->description('Name')
                ->required(true)
                ->schema(Schema::string()->maxLength(100))
                ->example("Slava user"),
            Parameter::query()
                ->name('phone')
                ->description('Phone')
                ->required(false)
                ->schema(Schema::string())
                ->example("+79622201732"),
            Parameter::query()
                ->name('email')
                ->description('Email')
                ->required(false)
                ->schema(Schema::string())
                ->example("slava@mail.ru"), 
            Parameter::query()
                ->name('message')
                ->description('Message')
                ->required(true)
                ->schema(Schema::string()->maxLength(1000))
                ->example("Message"), 

        ];
    }
}
