<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Enums\ProductAttributeType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttributeValue>
 */
class ProductAttributeValueFactory extends Factory
{
    /** @var Product[]|\Illuminate\Database\Eloquent\Collection */
    private $products;
    /** @var ProductAttribute[]*/
    private $attributeByCategoryId;
    private $attributes;
    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, ?Collection $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->products = Product::get();

        $this->attributes = ProductAttribute::get();
        $categoryIds = ProductAttribute::pluck('id')->all();
        foreach ($categoryIds as $categoryId){
            $this->attributeIdsByCategoryId[$categoryId] = $this->faker->randomElements($this->attributes);
        }
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [];
    }

    public function product(int $productId): self
    {
        return $this->state(function () use ($productId) {
            return [
                'product_id' => $productId,
            ];
        });
    }

    public function attribute(ProductAttribute $attribute): self
    {
        switch($attribute->type) {
            case ProductAttributeType::STRING:
                $value = $this->faker->realTextBetween(20, 50);
                break;
            case ProductAttributeType::NUMERIC:
                $value = random_int(1, 1000);
                break;
            case ProductAttributeType::BOOLEAN:
                $value = $this->faker->boolean;
                break;
            default:
                $value = '';
                break;
        }
        return $this->state(function () use ($attribute, $value) {
            return [
                'product_attribute_id' => $attribute->id,
                'value' => $value,
            ];
        });
    }

}
