<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
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
    public function index()
    {
        $user_id = Auth::user()->id;
        $data_absen = Absen::where('user_id', $user_id)
                        -> paginate(50);
        return view('home', compact('data_absen'));
    }
    public function absen(Request $request){
        $user_id = Auth::user()->id;
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $note = $request->note;

        $absen = new Absen;
        // absen masuk
        if ($request->has('btnIn')) {
            $absen->create([
                'user_id' => $user_id,
                'date' => $date,
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
}
