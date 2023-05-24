<?php 
use App\Models\User; ?>
@extends('print')
@section('content')
<table class="table mt-5 ">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Location</th>
      <th scope="col">Manager Name</th>
     
    </tr>
  </thead>
  <tbody>

<?php $no = 0; ?>
@foreach ($departements as $data)
<?php $no++; ?>
    
    <tr>
      <td>{{ $no }}</td>
      <td>{{ $data->name }}</td>
      <td>{{ $data->location }}</td>
      <td>{{
    (isset($data->manager->email)) ?
      $data->manager->email :
    
      'Tidak ada manager'
}}
</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection