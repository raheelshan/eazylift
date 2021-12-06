<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Bouncer;


class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('edit-user');
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
            'role' => ['required', 'integer'],
        ];
    } 

    public function handle(){

        $this->validated();

        $params = $this->all();

        if ($request->hasFile('identity')) {
            $identity = $request->file('identity');
        }        

        $user = User::find($this->id);
        $user->name = $params['name'];
        $user->email_verified_at = isset($params['email_verified']) ? date('Y-m-d H:i:s') : null;
        $user->save();

        Bouncer::sync($user)->roles([]);

        $user->assign($params['role']);

        return true;
    }
}
