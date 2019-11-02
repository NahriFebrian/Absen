<?php

namespace App\Transformers;

use Status;
use App\Transformers\StatusTransformer;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'status'
    ];

    public function transform( $status)
    {
        return [
            'id' => $status->id,
            'keterangan' => $status->keterangan,
        ];
    }

    public function includeStatus(Status $status)
    {
        $status  = $status->status()->latestFirst()->get();

        return $this->collection($status,new StatusTransformer);
    }
}
