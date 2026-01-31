<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id'    => ['required', 'uuid', 'exists:courses,id'],
            'title'        => ['required', 'string', 'max:255'],
            'content_url'  => ['required', 'url'],
            'order_number' => ['required', 'integer', 'min:1'],
        ];
    }
}
