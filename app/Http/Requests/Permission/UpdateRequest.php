<?php

namespace App\Http\Requests\Permission;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('role-edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => ['required','array', 'in:'. implode(',', Permission::all()->pluck('id')->toArray())]
        ];
    }
}
