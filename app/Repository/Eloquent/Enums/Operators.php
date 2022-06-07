<?php
namespace App\Repository\Eloquent\Enums;

enum Operators: string {
    case lte = "<=";
    case lt = "<";
    case gt = ">";
    case gte = ">=";
    case like = "like";
    case is = "=";
}
