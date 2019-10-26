@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $info['status']}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/absen" method="post">
                        {{csrf_field()}}
                        <table class="table table-responsive">
                            <tr>
                                <td>
                                    <input type="text" name="note" name="form-control" placeholder="Keterangan..." name="note">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-flat btn-primary" name="btnIn" {{$info['btnIn']}}>ABSEN MASUK</button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-flat btn-primary" name="btnOut" {{$info['btnOut']}}>ABSEN KELUAR</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Riwayat Absensi</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_absen as $absen)
                            <tr>
                                <td>{{$absen->date}}</td>
                                <td>{{$absen->time_in}}</td>
                                <td>{{$absen->time_out}}</td>
                                <td>{{$absen->note}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $data_absen->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
