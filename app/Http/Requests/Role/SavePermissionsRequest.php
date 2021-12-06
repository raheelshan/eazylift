<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Bouncer;

class SavePermissionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('edit-role-permissions');
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

    public function handle()
    {
        $params = $this->all();

        $role = $params['role'];


        Bouncer::sync($role)->abilities([]);

        $permissions = isset($params['permission']) ? $params['permission'] : [];

        foreach($permissions as $permission){
            Bouncer::allow($role)->to($permission);
        }

        return true;
    }    
}
