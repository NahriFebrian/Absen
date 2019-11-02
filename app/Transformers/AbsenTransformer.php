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
       ];
    }

    public function includeStatus(Absen $absen)
    {
        $status  = $absen->status()->get();

        return $this->collection($status,new StatusTransformer);
    }
}
