<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Transformers\AbsenTransformer;
use Auth; 
use App\Http\Controllers\Controller;

class AbsenController extends Controller
{
    public function add(Request $request,Absen $absen)
    {
        $this->validate($request,[
            'content' => 'required|min:10',
        ]);

        $absen = $absen->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        $response = fractal()
            ->item($absen)
            ->transformWith(new AbsenTransformer)
            ->toArray();

        return response()->json($response, 201);
    }

    public function update(Request $request,Absen $absen)
    {
        $this->authorize('update',$absen);

        $absen->content = $request->get('content', $absen->content);
        $absen->save();

        return fractal()
            ->item($absen)
            ->transformWith(new AbsenTransformer)
            ->toArray();
    }

    public function delete(Absen $absen)
    {
        $this->authorize('delete',$absen);

        $absen->delete();

        return response()->json([
            'message' => 'Absen delete'
        ]);
    }
}
