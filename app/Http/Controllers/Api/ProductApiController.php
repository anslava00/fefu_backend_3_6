<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListCatalogResources;
use App\Http\Resources\ProductResources;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Responses\CatalogListResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Exception;
use App\Models\Product;
use App\OpenApi\Responses\ErrorCatalogResponse;
use App\OpenApi\Responses\ProductResponse;
use App\OpenApi\Responses\NotFoundResponse;

#[OpenApi\PathItem]
class ProductApiController extends Controller
{
    /**
     * Returning a list of products by slug.
     *
     * @return \Illuminate\Http\Responseble
     */
    #[OpenApi\Operation(tags: ["catalog"])]
    #[OpenApi\Response(factory: CatalogListResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorCatalogResponse::class, statusCode: 422)]
    public function index(Request $request) {
        $slug = $request->query('category_slug');
        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try{
            $products = ProductCategory::getTreeProductsBuilder($categories)
                ->orderBy('id')
                ->paginate();
        }catch(Exception $exception) {
            return response()->json([
                'message' => 'Error',
                'errors' => $exception->getMessage(),
            ], 422);
        }

        return ListCatalogResources::collection($products);
    }
    /**
     * Returning a product resource by the requested slug
     *
     * @return \Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ["catalog"])]
    #[OpenApi\Response(factory: ProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(Request $request) {
        $slug = $request->query('category_slug');
        return new ProductResources(
            Product::query()
                ->with('productCategory', 'sortedAttributeValues.productAttribute')
                ->where('slug', $slug)
                ->firstOrFail()
        );
    }
}
