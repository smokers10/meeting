<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //inisialisasi table
    protected $table = 'project';

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetByid($query, $idProject)
    {
        return $this
                ->where('id_project', $idProject)
                ->get();
    }
    public function scopeAdd($query, $data)
    {
        return $this->insert($data);
    }
    public function scopeEdit($query, $data, $idProject)
    {
        return $this
                ->where('id_project', $idProject)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_project', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'nama_project','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }

}
