<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditResidentProfileRequest extends FormRequest
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
        $rules = array('firstname' => 'required',
                       'lastname' => 'required',
                       'email' => 'bail|email|required|max:255',
                       'username' => 'required|max:255',
                       );

        $photos = count($this->input('photos'));
        foreach(range(0, $photos) as $index) {
            $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        }
 
        return $rules;
    }
}
