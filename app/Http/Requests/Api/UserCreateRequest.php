<?php

namespace App\Http\Requests\Api;

use Exception;
use App\Http\Requests\Request;

class UserCreateRequest extends Request
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
            'name' => 'required'
        ];
    }


    // public function message(Exception $e)
    // {
    //     return response()->json([
    //         'code' => '422',
    //         'status' => 200,
    //         'messages' => $e->getMessage(),
    //     ]);
    // }
}
