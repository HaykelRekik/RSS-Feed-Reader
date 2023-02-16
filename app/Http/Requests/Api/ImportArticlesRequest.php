<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImportArticlesRequest extends FormRequest
{
    use ApiResponser;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'siteRssUrl' => ['required', 'url', 'active_url'], //make sure the url is reachable.
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'siteRssUrl.required' => 'The RSS feed url is required.',
            'siteRssUrl.url' => 'The RSS feed url must be a valid url.',
            'siteRssUrl.active_url' => 'The RSS feed url must be a reachable url.',
        ];
    }

    /**
     * Format the errors from the given Validator instance to keep the response consistent.
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            $this->errorResponse($validator->errors()->toArray(), 422)
        );
    }
}
