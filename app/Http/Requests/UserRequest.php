<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\AuthTraits\OwnsRecord;

class UserRequest extends FormRequest
{

    use OwnsRecord;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( ! $this->allowUserUpdate($this->user)){

            return false;

        }

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
            'name' => 'required|string|max:20|unique:users,name,' . $this->user,
            'is_subscribed' => 'required|boolean',
            'is_admin' => 'boolean',
            'status_id' => 'in:7,10',
        ];
    }
}
