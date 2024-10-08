<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    protected $fillable = [
        'id',
        'name'
    ];

    public function books(): BelongsToMany
    {
        return $this->BelongsToMany(Book::class);
    }
}
