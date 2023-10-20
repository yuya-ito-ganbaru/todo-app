<?php

namespace App\Http\Requests;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'required|max:20'
        ];
    }

    public function attributes()
    {
        return [
            'title' =>  'フォルダ名',
        ];
    }
}
