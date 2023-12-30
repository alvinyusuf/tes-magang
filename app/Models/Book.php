<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['author', 'category'];

    public function author(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
