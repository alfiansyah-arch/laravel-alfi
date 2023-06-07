@extends('app')
@section('content')
  <form action="{{ route('petugasjumat.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Kode Petugas:</strong>
                  <input type="text" name="kode_petugas" class="form-control" value="{{ $newCode }}" readonly>
                  @error('kode_petugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Nama Petugas:</strong>
                  <input type="text" name="nama_petugas" class="form-control" placeholder="Nama Petugas">
                  @error('nama_petugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Tanggal Lahir:</strong>
                  <input type="date" name="tgl_lahir" class="form-control">
                  @error('tgl_lahir')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Alamat Petugas:</strong>
                  <input type="text" name="alamat" class="form-control" placeholder="Alamat Petugas">
                  @error('alamat')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>No.HP Petugas:</strong>
                  <input type="number" name="no_telepon" class="form-control" placeholder="No Telepon Petugas">
                  @error('no_telepon')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Tugas:</strong>
                  <select name="tugas" class="form-control">
                  <option value="Khotib">Khotib</option>
                  <option value="Muadzin">Muadzin</option>
                  <option value="Muroqi">Muroqi</option>
                  </select>
                  @error('tugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Tanggal Bertugas:</strong>
                  <input type="date" name="tgl_bertugas" class="form-control" placeholder="Nama Petugas">
                  @error('tgl_bertugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Nama Masjid</strong>
                  <select name="nama_masjid" class="form-control">
                  @foreach ($masjids as $masjid)
                    <option value="{{ $masjid->nama_masjid }}">{{$masjid->nama_masjid}}</option>
                    @endforeach
                  </select>
                  @error('nama_masjid')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
      </div>
  </form>
@endsection