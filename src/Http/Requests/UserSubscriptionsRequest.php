<?php

declare(strict_types=1);

namespace GoldenGoose\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSubscriptionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subscriptions' => 'sometimes|required|array',
            'subscriptions.*' => 'exists:subscriptions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'subscriptions' => 'Wrong data',
            'subscriptions.*.exists' => 'One of selected subscription is unavailable now. Please, try again.',
        ];
    }
}
