<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartModificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modifications' => 'required|array|min:1',
            'modifications.*.product_id' => 'int|exists:products,id',
            'modifications.*.quantity' => 'int|min:0|max:99',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        if ($data !== null)
        {
            $modificationsData = $key === null ? $data['modifications'] : $data;
            $resultModificationsDataByProductId = [];
            foreach ($modificationsData ?? [] as $modificationItem)
            {
                $productId = (int)$modificationItem['product_id'];
                $resultModificationsDataByProductId[$productId] = [
                    'product_id' => $productId,
                    'quantity' => (int)$modificationItem['quantity'],
                ];
            }
            $resultModificationsData = array_values($resultModificationsDataByProductId);
            if ($key === null){
                $data = array_merge($data, ['modifications' => $resultModificationsData]);
            } else {
                $data = $resultModificationsData;
            }
        }
        return $data;
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
    
}
