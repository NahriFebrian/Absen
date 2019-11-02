<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transformers\StatusTransformer;
use App\Status;
use Auth;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function Status(Status $status){
    	$status = $status->all();

    	return fractal()
    	->collection($status)
    	->transformWith(new StatusTransformer())
    	->includeCharacters()
    	->toArray();
    }

    public function profile(Status $status)
    {
        $status = $status->find(Auth::status()->id);

        return fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->includeStatus()
            ->toArray();
    }

    public function profileById(Status $status,$id)
    {
        $status = $status->find($id);

        return fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->includeStatus()
            ->toArray();
    }

    public function add(Request $request,Status $status)
    {
        $this->validate($request,[
            'keterangan' => 'required'
        ]);

        $status = $status->create([
            'keterangan' => $request->keterangan,
            // 'user_id' => Auth::user()->id
        ]);

        $response = fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->toArray();

        return response()->json($response, 201);
    }

    public function update(Request $request,Status $status)
    {
        $this->authorize('update', $status);
        
        $status = $status->fill($request->all());
        $status->save();


        return fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->toArray();
    }

    public function delete(Status $status)
    {

        $status->delete();

        return response()->json([
            'message' => 'status delete'
        ]);
    }
}
