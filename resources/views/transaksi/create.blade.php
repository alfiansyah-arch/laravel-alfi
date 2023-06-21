@extends('app')
@section('content')
<form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>No. Transaksi:</strong>
              <input type="text" name="no_transaksi" class="form-control" placeholder="Nomor Transaksi">
              @error('no_transaksi')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Pemesan :</strong>
              <select name="id_pemesan" id="id_pemesan" class="form-select">
                <option value="">Pilih</option>
                @foreach ($managers as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
              </select>
              @error('id_pemesan')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Tanggal Pesan:</strong>
              <input type="date" name="tgl_transaksi" class="form-control" placeholder="Tanggal Transaksi">
              @error('tgl_transaksi')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Nama Masjid:</strong>
              <input type="text" name="nama_masjid" class="form-control" placeholder="Nama Masjid">
              @error('nama_masjid')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Alamat Masjid:</strong>
              <input type="text" name="alamat" class="form-control" placeholder="Alamat Masjid">
              @error('alamat')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
          <div class="form-group col-10">
              <input type="text" name="search" id="search" class="form-control" placeholder="Pilih Petugas">
              @error('search')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group col-2">
              <button type="text" class="btn btn-secondary"> Tambah </button>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Tugas</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="detail">
                
            </tbody>
        </table>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="hidden" name="jml" class="form-control" >
          <div class="form-group">
              <strong>Grand Total:</strong>
              <input type="text" name="total" class="form-control" placeholder="Rp. 0">
              @error('total')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
          </div>
      </div>
      </div>
      <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
  </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.ptg') }}";
  
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
           console.log($("input[name=jml]").val());
            if($("input[name=jml]").val() > 0){
                for (let i = 1; i <=  $("input[name=jml]").val(); i++) {
                    id = $("input[name=kd_petugas"+i+"]").val();
                    if(id==ui.item.id){
                        alert(ui.item.value+' sudah ada!');
                        break;
                    }else{
                        add(ui.item.id);
                    }
                }
            }else{
                add(ui.item.id);
            } 
           return false;
        }
      });

    function add(id){
        // console.log(id);
        const path = "{{ route('petugas.index') }}/"+id;
        var html = "";
        var no=0;
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            
            success: function( data ) {
                if($('#detail tr').length > no){
                    html = $('#detail').html();
                    no = $('#detail tr').length;
                }
                no++;
                html+='<tr>'+
                        '<td>'+
                            '<input type="hidden" name="kd_petugas'+no+'" class="form-control" value="'+data.id+'">'+
                            '<span>'+no+'</span>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="petugasName'+no+'" class="form-control" value="'+data.nama_petugas+'" >'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="tugas'+no+'" class="form-control" value="'+data.tugas+'" >'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="price'+no+'" class="form-control" value="'+data.price+'" >'+
                        '</td>'+
                        '<td>'+
                            '<a href="#" class="btn btn-sm btn-danger">X</a>'+
                        '</td>'+
                    '</tr>';

                    $('#detail').html(html);
                    $("input[name=jml]").val(no);
            }
          });
    }

    function sumQty(no, q){
        var price = $("input[name=price"+no+"]").val();
        var subtotal = q*parseInt(price);
        $("input[name=sub_total"+no+"]").val(subtotal);
        console.log(q+"*"+price+"="+subtotal);
        sumTotal();
    }

    function sumTotal(){
    var total = 0;
       for (let i = 1; i <=  $("input[name=jml]").val(); i++) {
        var sub = $("input[name=price"+i+"]").val();
        total = total + parseInt(sub);
       }
       $("input[name=total]").val(total);
    }
  
</script>
@endsection