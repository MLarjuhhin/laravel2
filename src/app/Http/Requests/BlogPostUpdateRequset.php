<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequset extends FormRequest
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
            'title'       => 'required|min:3|max:200',
            'slug'        => 'max:200',
            'excerpt'     => 'max:500',
            'content_row' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categoties,id'
        ];
    }
}
