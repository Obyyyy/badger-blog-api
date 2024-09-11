<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasAuthor, ModelHelper;

    const TABLE = 'articles';
    protected $table = self::TABLE;
    protected $fillable = [
        'title',
        'slug',
        'body',
        'author_id',
    ];

    // public function id(): string {
    //     return (string) $this->id;
    // }
}