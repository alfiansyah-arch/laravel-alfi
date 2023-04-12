@extends('app')
@section('content')
@if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

<div class="text-end mb-2">
                    <a class="btn btn-success" href="{{ route('positions.create') }}">Add Position</a>
                </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Alias</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1; @endphp
  @foreach ($positions as $val)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->keterangan }}</td>
                        <td>{{ $val->alias }}</td>
                        <td>
                            <form action="{{ route('positions.destroy',$val->id) }}" method="Post">
                                <a class="btn btn-warning" href="{{ route('positions.edit',$val->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

  </tbody>
</table>
@endsection