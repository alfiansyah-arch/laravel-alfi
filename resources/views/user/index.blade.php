<?php 
use App\Models\User; 
use App\Models\Position;
?>
@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-info" href="{{ route('exportpdf')}}">Print</a>
  <!-- <a class="btn btn-success" href="{{ route('departements.create') }}"> Create Departement</a> -->
</div>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Position</th>
      <th scope="col">Department</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($user as $val)
    <tr>
      <td>{{ $no ++ }}</td>
      <td>{{ $val->name }}</td>
      <td>{{ $val->email }}</td>
      <td>
      @if ($val->position == 1)
    Manager
  @elseif ($val->position == 2)
    Karyawan
    @elseif ($val->position == 3)
    Magang
    @else
    Tidak Masuk Position
  @endif
  </td>
  <td>{{ $val->department }}</td>
      <td>
        <form action="{{ route('departements.destroy',$val->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('departements.edit',$val->id) }}">Edit</a>
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