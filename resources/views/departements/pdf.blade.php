<?php use App\Models\User; ?>
@extends('print')
@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Location</th>
      <th scope="col">Id Manager</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($departements as $val)
    <tr>
      <td>{{ $no ++ }}</td>
      <td>{{ $val->name }}</td>
      <td>{{ $val->location }}</td>
      <td>
    @if($val->manager)
      {{ $val->manager->name }}
    @else
      Tidak ada manager
    @endif
  </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection