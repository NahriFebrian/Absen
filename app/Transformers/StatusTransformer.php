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

    public function transform()
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
        ];
    }

    public function includePosts(Status $status)
    {
        $status  = $status->status()->latestFirst()->get();

        return $this->collection($status,new BookTransformer);
    }
}
