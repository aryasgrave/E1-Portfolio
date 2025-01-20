<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tag;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo',
        'link',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
