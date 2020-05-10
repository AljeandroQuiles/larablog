<?php

namespace App\Http\Requests;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;

class StorePostPost extends FormRequest
{
   
    public static function myRules(){
        return [
            //'title' => 'required|min:5|max:500',
            'url_clean' => 'max:500|unique:posts',
            'content' => 'required|min:5',
            'category_id' => 'required',
            'posted' => 'required',
            'tags_id' => 'required',
            'title' =>[
                'required',
                'min:5',
                'max:500',
                new UpperCase()
            ]

        ];

    }

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
        //dd($this->myRules());
        return $this->myRules();
    }
}
