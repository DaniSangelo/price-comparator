<?php

namespace App\Infra\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebhookSubscriptionRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => 'required|url',
            'method' => 'required|in:POST,GET,PUT',
            'secret' => 'required|string',
            'event' => 'required|string',
            'is_active' => 'required|boolean',
        ];
    }
}
