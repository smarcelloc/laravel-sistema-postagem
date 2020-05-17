<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use App\Rules\Password;
use App\Rules\AlphaSpace;
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
        return $this->user()->can('user-edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', new AlphaSpace, 'max:255'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:users,email,' .$this->user->id],
            'password' => ['nullable','string', new Password, 'min:8', 'max:45', 'confirmed'],
            'timezone' => ['required', 'string', 'max:45', 'timezone'],
            'roles' => ['array', 'in:'. implode(',', Role::all()->pluck('id')->toArray())]
        ];
    }
}
