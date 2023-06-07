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
  <a class="btn btn-info" href="">Print</a>
  <a class="btn btn-success" href="">Tambah Petugas</a>
</div>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Petugas</th>
      <th scope="col">Nama Petugas</th>
      <th scope="col">Tgl Lahir</th>
      <th scope="col">Alamat</th>
      <th scope="col">No.Telepon</th>
      <th scope="col">Tugas</th>
      <th scope="col">Tgl Bertugas</th>
      <th scope="col">Nama Masjid</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($petugas as $val)
    <tr>
      <td>{{ $no ++ }}</td>
      <td>{{ $val->kode_petugas }}</td>
      <td>{{ $val->nama_petugas }}</td>
      <td>{{ $val->tgl_lahir }}</td>
      <td>{{ $val->alamat }}</td>
      <td>{{ $val->no_telepon }}</td>
      <td>{{ $val->tugas }}</td>
      <td>{{ $val->tgl_bertugas }}</td>
      <td>{{ $val->nama_masjid }}</td>
      <td>
        <form action="" method="Post">
          <a class="btn btn-primary" href="">Edit</a>
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
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.masjid') }}";
  
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
      });
  
</script>
@endsection