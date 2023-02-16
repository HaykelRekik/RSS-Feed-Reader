<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'externalId' => $this->externalId,
            'title' => $this->title,
            'description' => $this->description,
            'publicationDate' => $this->publicationDate,
            'link' => $this->link,
            'mainPicture' => $this->mainPicture,
            'importDate' => $this->whenLoaded('import', function () {
                return $this->import->importDate->format('Y-m-d H:i:s');
            }),
            'wordlWithMostVoewls' => findWordWithMostVowels($this->title),
        ];
    }
}
