<?php

namespace App\Transformers;

use App\Absen;
use League\Fractal\TransformerAbstract;

class AbsenTransformer extends TransformerAbstract
{
    
    public function transform(Absen $absen)
    {
        return [
            'id'             =>  $absen->id,
            'user_id'        =>  $absen->user_id,
            'status_id'         =>  $absen->status_id,
            'date'         =>  $absen->date,
            'nama'         =>  $absen->nama,
            'email'         =>  $absen->email,
            'time_in'         =>  $absen->time_in,
            'time_out'         =>  $absen->time_out,
       ];
    }

    public function includeStatus(Absen $absen)
    {
        $status  = $absen->status()->get();

        return $this->collection($status,new StatusTransformer);
    }
}
