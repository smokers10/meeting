<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PokokBahasan extends Model
{
    protected $table = "pokok_bahasan";

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetById($query, $idPokokBahasan)
    {
        return $this
                ->where('id_pokok_bahasan', $idPokokBahasan)
                ->get();
    }

    public function scopeGetByMom($query, $id_mom)
    {
        return $this
                ->where('id_mom', $id_mom)
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
                ->where('id_pokok_bahasan', $id)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_pokok_bahasan', $id)
                ->delete();
    }

    public function scopeSearch($query, $id, $keyword, $limit)
    {
        return $this
                ->where(
                    'pokok_bahasan','like',"%$keyword%"
                )
                ->where(
                    'id_mom', $id
                )
                ->simplePaginate($limit);
    }
}
