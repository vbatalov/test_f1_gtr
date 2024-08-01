<?php

namespace App\Http\Requests\Order;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => [
                "integer",
                "required_without_all:orderBy,customer,status,orderBy"
//                Rule::exists("orders", "id")
            ],
            "orderBy" => [
                Rule::in([
                    "asc", "desc",
                ]),
                "required_without_all:id,customer,status"
            ],
            "customer" => [
                "string",
                "required_without_all:id,orderBy,status",
                Rule::exists("orders", "customer")
            ],
            "status" => [
                Rule::enum(StatusEnum::class),
                "required_without_all:id,orderBy,customer"
            ],
        ];
    }
}
