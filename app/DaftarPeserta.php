<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarPeserta extends Model
{
    protected $table = "daftar_peserta";

    protected $primaryKey = "id_daftar_peserta";

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetById($query, $idPeserta)
    {
        return $this
                ->where('id_daftar_peserta', $idPeserta)
                ->get();
    }

    public function scopeGetByMom($query, $idMom)
    {
        return $this
                ->where('id_mom', $idMom)
                ->get();
    }

    public function scopeAdd($query, $data)
    {
        return $this
                ->insert($data);
    }

    public function scopeEdit($query, $data, $id)
    {
        return $this
                ->where('id_daftar_peserta', $id)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_daftar_peserta', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'nama','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }

}
