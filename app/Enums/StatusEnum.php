<?php

namespace App\Enums;
enum StatusEnum: string
{
    case ACTIVE = "active";
    case COMPLETED = "completed";
    case CANCELED = "canceled";

    public static function toArray(): array
    {
        return array_column(StatusEnum::cases(), 'value');
    }
}
