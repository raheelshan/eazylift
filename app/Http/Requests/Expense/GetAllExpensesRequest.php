<?php

namespace App\Http\Requests\Expense;

use App\Models\Expense;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllExpensesRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-expenses');
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

        return Expense::all();

    }
}
