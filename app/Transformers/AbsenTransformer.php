<?php

namespace App\Transformers;

use App\Absen;
use League\Fractal\TransformerAbstract;

class AbsenTransformer extends TransformerAbstract
{
    
    public function transform()
    {
        return [
            'id'             =>  $absen->id,
            'user_id'        =>  $absen->user_id,
            'status'         =>  $absen->status,
            'idketerangan'   =>  $absen->keterangan,
        ];
    }
}
