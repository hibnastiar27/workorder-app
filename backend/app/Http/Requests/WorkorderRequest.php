<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkorderRequest extends FormRequest
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

        if ($this->routeIs('workorders-op.updateStatus')) {
            return [
                'status' => 'required|in:Pending,In Progress,Completed',
            ];
        }

        return [
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'deadline' => 'required|date',
            'status' => 'in:Pending,In Progress,Completed,Canceled',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
