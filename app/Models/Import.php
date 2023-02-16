<?php

namespace App\Models;

use App\Models\Article;
use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'importDate',
        'rawContent',
    ];

    protected $dates = [
        'importDate',
    ];

    /**
     * Get the articles of the Import.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Set the rawContent attribute as a JSON string.
     *
     * @param  string  $value
     * @return array
     */
    public function setRawContentAttribute($value)
    {
        $this->attributes['rawContent'] = json_encode($value);
    }
}
