<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;


class MoM extends Model
{
    //inisialisasi table
    protected $table = 'mom';

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetByid($query, $id)
    {
        return $this
                ->join('users', 'users.id', '=', 'mom.id')
                ->where('id_mom', $id)
                ->get();
    }

    public function scopeGetByProject($query, $idProject)
    {
        return $this
                ->where('id_project', $idProject)
                ->get();
    }

    public function scopeAdd($query, $data)
    {
        return $this->insert($data);
    }

    public function scopeEdit($query, $data, $id)
    {
        return $this
                ->where('id_mom', $id)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_mom', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'agenda','like',"%$keyword%"
                )
                ->orWhere(
                    'kesimpulan','like',"%$keyword%"
                )
                ->orWhere(
                    'lokasi','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }
    
}
