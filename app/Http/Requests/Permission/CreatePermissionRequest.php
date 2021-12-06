<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Silber\Bouncer\Database\Ability;
use Bouncer;

class CreatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'title' => ['required', 'string'],
        ];
    }

    public function handle(){

        $this->validated();

        $params = $this->all();

        $permission = new Ability();

        $permission->name = $params['name'];
        $permission->title = $params['title'];

        $permission->save();        

        return true;
    }  
}
