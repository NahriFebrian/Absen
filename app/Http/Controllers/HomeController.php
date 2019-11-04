<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Status;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function timeZone($location){
        return date_default_timezone_set($location);
    }
    public function index()
    {
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        $date = date("Y-m-d");
        $cek_absen = Absen::where(['user_id' => $user_id, 'date' => $date])
                        ->get()
                        ->first();
        if (is_null($cek_absen)) {
            $info = array(
                "status" => "Anda belum mengisi absensi!",
                "btnIn" => "",
                "btnOut" => "disabled");
        } elseif ($cek_absen->time_out == NULL) {
            $info = array(
                "status" => "Jangan lupa absen keluar!",
                "btnIn" => "disabled",
                "btnOut" => "");
        } else{
             $info = array(
                "status" => "Absensi hari ini telah selesai!",
                "btnIn" => "disabled",
                "btnOut" => "disabled");
        }
        $data_absen = Absen::where('user_id', $user_id)
                        -> paginate(20);

        $status = Status::select('id', 'keterangan')->get();
        return view('home', compact('data_absen', 'info', 'status'));
    }
    public function absen(Request $request){
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $note = $request->note;

        $absen = new Absen;
        // absen masuk
        if ($request->has('btnIn')) {
            // cek double data
            $cek_double = $absen->where(['date' => $date, 'user_id' => $user_id])
                                ->count();
            if ($cek_double > 0) {
                return redirect()->back();
            }
            $absen->create([
                'user_id' => $user_id,
                'status_id' => $request->note,
                'date' => $date,
                // 'nama' => Auth::user()->name,
                // 'email' => Auth::user()->email,
                'time_in' => $time,
                'note' => $note]);
            return redirect()->back();

        }
        // absen keluar
        elseif ($request->has('btnOut')) {
            $absen->where(['date' => $date, 'user_id' => $user_id ])
                    ->update([
                        'time_out' => $time,
                        'note' => $note]);
             return redirect()->back();
        }
    }

    public function create(Request $request)
    {
        \App\Siswa::create($request->all());
        return redirect('/absen')->with('sukses', 'Data Absensi Berhasil Ditambahkan!!');
    }

    public function store(Request $request){
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        
        $absen = new Absen;
            $absen->create([
                'user_id' => $user_id,
                'status_id' => $request->note,
                'date' => $request->tanggal,
                // 'nama' => $request->nama,
                // 'email' => $request->email,
                'time_in' => $request->jam_masuk,
                'time_out' => $request->jam_keluar,
            ]);
            return redirect('/home');
    }

    public function edit($id)
    {
        $absen = \App\Absen::find($id);
        return view('edit', ['absen' => $absen]);
    }
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $absen = \App\Absen::find($id);
        $absen->update([
            'user_id' => $user_id,
            'status_id' => $request->note,
            'date' => $request->tanggal,
            // 'nama' => $request->nama,
            // 'email' => $request->email,
            'time_in' => $request->jam_masuk,
            'time_out' => $request->jam_keluar,
            'note' => $request->note
        ]);
        return redirect('/home')->with('sukses', 'Data Absensi Berhasil Diubah!!');
    }
    public function delete($id)
    {
        $absen = \App\Absen::find($id);
        $absen->delete($absen);
        return redirect('/home')->with('sukses', 'Data Absensi Berhasil Dihapus!!');
    }
}
