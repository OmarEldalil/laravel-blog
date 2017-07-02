<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'slug'=>['required', 'alpha_dash', 'min:5', 'max:255', Rule::unique('posts')->ignore($this->id)],
            'category_id' =>'required|integer',
            'body'=> 'required',
            'img'=> 'sometimes|image'
        ];

    }
}
