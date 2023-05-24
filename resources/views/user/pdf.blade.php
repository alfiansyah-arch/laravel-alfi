<?php 
use App\Models\User; 
use App\Models\Position;
?>
@extends('print')
@section('content')

<table class="table mt-5 ">
        <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Position</th>
      <th scope="col">Department</th>
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
    </tr>
    @endforeach
  </tbody>
</table>
@endsection