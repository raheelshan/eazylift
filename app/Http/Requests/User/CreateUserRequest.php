<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Bouncer;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'integer'],
        ];
    }

    public function handle(){

        $this->validated();

        $params = $this->all();

        $user = new User();

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->password = Hash::make($params['password']);
        $user->email_verified_at = isset($params['email_verified']) ? date('Y-m-d H:i:s') : null;

        $user->save();

        $user->assign($params['role']);

        return true;
    }    
}
