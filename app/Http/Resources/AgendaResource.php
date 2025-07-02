<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'agenda' => $this->agenda,
            'nama_kegiatan' => $this->nama_kegiatan,
            'tanggal_kegiatan' => $this->tanggal_kegiatan,
            'lokasi' => $this->lokasi,
            'penyelenggara' => $this->penyelenggara,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'message' => 'Data Kegiatan Retrieved Successfuly'
        ];
    }
}
