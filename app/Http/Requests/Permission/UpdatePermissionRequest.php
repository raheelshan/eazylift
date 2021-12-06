<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Silber\Bouncer\Database\Ability;
use Bouncer;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('edit-permission');
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

        $permission = Ability::find($this->id);

        $permission->name = $params['name'];
        $permission->title = $params['title'];

        $permission->save();        

        return true;
    } 
}
