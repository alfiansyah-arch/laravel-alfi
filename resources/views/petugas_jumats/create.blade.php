@extends('app')
@section('content')
  <form action="{{ route('petugas_jumats.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Nama Petugas:</strong>
                  <input type="text" name="nama_petugas" class="form-control" placeholder="Nama Lengkap">
                  @error('nama_petugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Tugas:</strong>
                  <input type="text" name="tugas" class="form-control" placeholder="Bertugas Sebagai">
                  @error('tugas')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Harga:</strong>
                  <input type="text" name="price" class="form-control" placeholder="Harganya Berapa">
                  @error('price')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
      </div>
  </form>
@endsection