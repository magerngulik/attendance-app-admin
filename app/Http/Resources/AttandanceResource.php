<?php

namespace App\Http\Resources;

use App\Helpers\ImageHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AttandanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id'=> $this->user_id,
            "waktu_masuk"=> $this->waktu_masuk,
            "waktu_keluar"=> $this->waktu_keluar,
            "lokasi_masuk"=> $this->lokasi_masuk,
            "lokasi_keluar"=> $this->lokasi_keluar,
            "tanggal"=> $this->tanggal,
            "waktu_kerja"=> $this->waktu_kerja,
            "evidence"=> ImageHelper::convertImagePathToUrl($this->evidence),
            "device"=> $this->device
        ];
    }
}
