<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MangaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'titulo' => $this->titulo,
            'portada' => $this->portada,
            'categoria' => $this->categoria->nombre,
            'subcategorias' => $this->categoria->subcategorias,
        ];
    }
}
