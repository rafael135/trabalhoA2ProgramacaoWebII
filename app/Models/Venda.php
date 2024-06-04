<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "lanche_id",
        "quantity",
        "total_price",
        "date"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
