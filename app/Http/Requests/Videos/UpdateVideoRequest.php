<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
        $videoId = $this->video ?? $this->route('id');

        return [
            'title'         => 'required|string|max:255|unique:videos,title,' . $videoId,
            'description'   => 'required|string',
            'status'        => 'required|in:published,draft',
        ];
    }
}
