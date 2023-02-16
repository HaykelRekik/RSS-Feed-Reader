<?php

namespace App\Models;

use App\Models\Import;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'externalId',
        'title',
        'description',
        'publicationDate',
        'link',
        'mainPicture',
        'import_id',
    ];

    protected $dates = [
        'publicationDate' => 'datetime',
    ];

    protected $with = [
        'import:id,importDate',
    ];
    /**
     * Get the import of the Article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function import(): BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
}
