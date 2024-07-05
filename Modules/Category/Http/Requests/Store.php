<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public mixed $title;

    public mixed $parent_id;

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'photo' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
