@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Ubah Data Absensi
            </div>
            <form action="/absen/{{$absen->id}}/update" method="POST">
                {{csrf_field()}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input name="tanggal" value="{{ $absen->date}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="2019-01-01">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama</label>
                    <input name="nama" value="{{ $absen->nama}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect">Email</label>
                    <input name="email" value="{{ $absen->email}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="aa@gmail.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jam Masuk</label>
                    <input name="jam_masuk" value="{{ $absen->time_in}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="17:20:56">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jam Keluar</label>
                    <input name="jam_keluar" value="{{ $absen->time_out}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="17:20:56">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keterangan</label>
                    <select class="form-control" id="note" name="note" value="{{ $absen->note}}">
                        <option value="Hadir">Hadir</option>
                        <option value="Alpa">Alpa</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Ijin">Ijin</option>               
                        <option value="Lembur">Lembur</option>               
                    </select>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
