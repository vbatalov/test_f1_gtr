<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class HistoryStockRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "filter" => [
                "array"
            ],
            "filter.warehouse_id" =>
                [
                    "int"
                ],
            "filter.product_id" => [
                "int"
            ],
            "filter.dateFrom" => [
                "date"
            ],
            "filter.dateTo" => [
                "date"
            ],
        ];
    }
}
