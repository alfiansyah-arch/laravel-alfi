<?php use App\Models\User; ?>
@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-success" href="{{ route('petugas_jumats.create') }}">Add Petugas</a>
</div>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Petugas</th>
      <th scope="col">Tugas</th>
      <th scope="col">Harga</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($ptgs as $val)
    <tr>
      <td>{{ $no ++ }}</td>
      <td>{{ $val->nama_petugas }}</td>
      <td>{{ $val->tugas }}</td>
      <td>{{ $val->price }}</td>
      <td>
        <form action="{{ route('petugas_jumats.destroy',$val->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('petugas_jumats.edit',$val->id) }}">Edit</a>
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
@section('js')
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>
@endsection