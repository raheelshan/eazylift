<?php

namespace App\Http\Requests\User;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;


class GetUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function handle(){

        return User::findOrNew($this->id);
    }    
}
