@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                                    <select class="form-control" id="note" name="note">
                                        @foreach($status as $data)
                                            <option value="{{ $data->id }}">{{ $data->keterangan }}</option>
                                        @endforeach
                                    </select>
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
        <div class="col-md-6">
           <div class="card">
               <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#exampleModalLong">Tambah Data Absensi</button>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <!-- <th>Nama</th>
                            <th>Email</th> -->
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_absen as $absen)
                            <tr>
                                <td>{{$absen->status_id}}</td>
                                <td>{{$absen->date}}</td>
                                <!-- <td>{{$absen->nama}}</td>
                                <td>{{$absen->email}}</td> -->
                                <td>{{$absen->time_in}}</td>
                                <td>{{$absen->time_out}}</td>
                                <td>
                                    <a href="/absen/{{$absen->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/absen/{{$absen->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                                </td>
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

<!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/absen/store" method="POST">
                <div class="modal-body">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input name="tanggal" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="2019-01-01">
                      </div>
                     <!--  <div class="form-group">
                        <label for="exampleInputPassword1">Nama</label>
                        <input name="nama" type="text" value="{{Auth::user()->name}}" class="form-control" id="exampleInputPassword1" placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect">Email</label>
                        <input name="email" type="text" value="{{Auth::user()->email}}" class="form-control" id="exampleInputPassword1" placeholder="aa@gmail.com">
                    </div> -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jam Masuk</label>
                        <input name="jam_masuk" type="text" class="form-control" id="exampleInputPassword1" placeholder="17:20:56">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jam Keluar</label>
                        <input name="jam_keluar" type="text" class="form-control" id="exampleInputPassword1" placeholder="17:20:56">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <select class="form-control" id="note" name="note">
                            @foreach($status as $data)
                                <option value="{{ $data->id }}">{{ $data->keterangan }}</option>
                            @endforeach             
                        </select>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection
