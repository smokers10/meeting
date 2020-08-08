<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPokokBahasan extends Model
{
    protected $table = 'detail_pokok_bahasan';

    public function scopeGetAll($query, $idPokokBahasan)
    {
        return $this
                ->where('id_pokok_bahasan', $idPokokBahasan)
                ->get();
    }

    public function scopeGetById($query, $idDetailPokokBahasan)
    {
        return $this
                ->where('id_detail_pokok_bahasan', $idDetailPokokBahasan)
                ->get();
    }

    public function scopeAdd($query, $data)
    {
        return $this
                ->insert($data);
    }

    public function scopeEdit($query, $data, $idPokokBahasan)
    {
        return $this
                ->where('id_detail_pokok_bahasan', $idPokokBahasan)
                ->update($data);
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'detail_pokok_bahasan','like',"%keyword%"
                )
                ->simplePaginate($limit);
    }






}
