<?php

namespace App\Http\Requests\Expense;

use App\Models\Expense;
use App\Http\Requests\BaseRequest;
use Bouncer;

class UpdateExpenseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('update-expense');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function handle(){

        $this->validated();

        $params = $this->all();

        return Expense::where('id', $this->id)->update($params);
    }    
}
