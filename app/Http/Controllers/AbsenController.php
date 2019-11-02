<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Absen;
use App\Transformers\AbsenTransformer;
use Auth; 
use App\Http\Controllers\Controller;

class AbsenController extends Controller
{
    public function profileById(Absen $absen,$id)
    {
        $absen = $absen->find($id);

        return fractal()
            ->item($absen)
            ->transformWith(new AbsenTransformer)
            ->includestatus()
            ->addMeta([
                'status' => $absen->status->keterangan,
            ])
            ->toArray();
    }

    public function add(Request $request,Absen $absen)
    {
        $this->validate($request,[
            'keterangan' => 'required',
        ]);

        $absen = $absen->create([
            'user_id' => Auth::user()->id,
            'status_id' => $request->keterangan,
        ]);

        $response = fractal()
            ->item($absen)
            ->transformWith(new AbsenTransformer)
            ->addMeta([
                'status' => $absen->status->keterangan,
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function update(Request $request,Absen $absen)
    {
        $this->authorize('update',$absen);

        $absen = $absen->fill($request->all());
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
