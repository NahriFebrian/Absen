<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transformers\BookTransformer;
use App\Book;
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
            ->includeposts()
            ->toArray();
    }

    public function profileById(Status $status,$id)
    {
        $status = $status->find($id);

        return fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->includeposts()
            ->toArray();
    }

    public function add(Request $request,Status $status)
    {
        $this->validate($request,[
            'id' => 'required',
            'nama' => 'required'
        ]);

        $status = $status->create([
            'id' => $request->id,
            'nama' => $request->penulis,
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

        $status->id = $request->get('id', $status->id);
        $status->nama = $request->get('nama',$status->nama);
        $status->save();

        return fractal()
            ->item($status)
            ->transformWith(new StatusTransformer)
            ->toArray();
    }

    public function delete(Status $status)
    {
        $this->authorize('delete',$status);

        $status->delete();

        return response()->json([
            'message' => 'status delete'
        ]);
    }
}
