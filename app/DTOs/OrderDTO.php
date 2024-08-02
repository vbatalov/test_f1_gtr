<?php

namespace App\DTOs;

use App\Enums\StatusEnum;
use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class OrderDTO extends ValidatedDTO
{

//    use EmptyRules;
    protected function rules(): array
    {
        return [
            "id" => "int",
            "completed_at" => "nullable|date",
            "warehouse_id" => [
                "int"
            ],
            "customer" => "string",
            "status" => [
                Rule::enum(StatusEnum::class),
            ]
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
