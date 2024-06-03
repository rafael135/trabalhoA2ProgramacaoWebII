<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lanche extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "description",
        "price",
        "quantity",
        "image_url",
    ];

    protected $table = "lanches";

    public function usuario(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
