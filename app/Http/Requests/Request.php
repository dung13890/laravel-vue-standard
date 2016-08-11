<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
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
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        if ($this->wantsJson()) {
            // dd($validator->getMessageBag());
            return \Response::json([$validator->getMessageBag()]);       
            // return response()->json($validator->getMessageBag());
            // return [
            //     'message' => trans('validation.failed'),
            //     'errors' => array_map('array_pop', $validator->getMessageBag()->toArray()),
            // ];
        }

        return parent::formatErrors($validator);
    }
}
