<?php

namespace App\Http\Controllers\Api;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

use App\Models\Appeal;
use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\AppealSubmitParameters;
use App\OpenApi\Responses\EmptyResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use App\Sanitizers\PhoneSanitizer;
use App\Http\Requests\AppealApiRequest;

#[OpenApi\PathItem]
class AppealApiController extends Controller
{
    /**
     * Accepts post requests and writes to the DB .
     * @param AppealApiRequest
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ["appeal"], method:'POST')]
    #[OpenApi\Parameters(factory: AppealSubmitParameters::class)]
    #[OpenApi\Response(factory: EmptyResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function store(AppealApiRequest $request){
        $data = $request->validated();

        $appeal = new Appeal();
        $appeal->name = $data['name'];
        $appeal->phone = PhoneSanitizer::sanitize($data['phone']??null);
        $appeal->email = $data['email']??null;
        $appeal->message = $data['message'];
        
        $appeal->save();
        return response()->json([
            'message' => 'Successful'], 200
        );
    }
}
