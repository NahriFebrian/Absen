<?php

namespace App\Transformers;

use App\User;
use App\Transformers\AbsenTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'absen'
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'registered' => $user->created_at->diffForHumans(),
        ];
    }

    public function includePosts(User $user)
    {
        $posts  = $user->posts()->latestFirst()->get();

        return $this->collection($absen,new AbsenTransformer);
    }
}
