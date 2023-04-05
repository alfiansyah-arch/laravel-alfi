@extends('app')
@section('content')
  <form action="{{ route('positions.update', $position->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Name:</strong>
                  <input type="text" name="name" class="form-control" value="{{ $position->name }}" placeholder="Nama Lengkap">
                  @error('name')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Keterangan:</strong>
                  <input type="text" name="keterangan" class="form-control" value="{{ $position->keterangan }}" placeholder="Keterangan Posisi">
                  @error('keterangan')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Alias:</strong>
                  <input type="text" name="alias" class="form-control" value="{{ $position->alias }}" placeholder="Contoh : 'Office Boy', 'Owner'">
                  @error('alias')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
      </div>
  </form>
@endsection