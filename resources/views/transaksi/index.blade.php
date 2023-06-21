@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" 
  aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
<a class="btn btn-secondary" href="{{ route('transaksi.create') }}">Pesan</a>
</div>
<table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>        
      <th scope="col">No. Transaksi</th>   
      <th scope="col">Tanggal Transaksi</th>
      <th scope="col">Pemesan</th>
      <th scope="col">Masjid</th>
      <th scope="col">Alamat</th>
      <th scope="col">Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($trs as $data)
    <tr>
        <td>{{ $data->id }}</td>
        <td>{{ $data->no_transaksi }}</td>
        <td>{{ $data->tgl_transaksi }}</td>
        <td>{{ 
          (isset($data->getManager->name)) ? 
          $data->getManager->name : 
          'Tidak Ada'
          }}
        </td>
        <td>{{ $data->nama_masjid }}</td>
        <td>{{ $data->alamat }}</td>
        <td>{{ $data->total }}</td>
        <td>
            <form action="{{ route('transaksi.destroy',$data->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('transaksi.edit',$data->id) }}">Edit</a>
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