@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Show Barang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">


        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('products.update',$product->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kode Barang:</strong>
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="text" name="kode_barang" value="{{ $product->kode_barang }}" class="form-control" placeholder="Kode Barang">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Barcode:</strong>
                        <input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control" placeholder="Barcode">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Barang:</strong>
                        <input type="text" name="nama_barang" value="{{ $product->nama_barang }}" class="form-control" placeholder="Nama Barang">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Satuan:</strong>
                        <input type="text" name="satuan" value="{{ $product->satuan }}" class="form-control" placeholder="Satuan">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Merk:</strong>
                        <input type="text" name="merk" value="{{ $product->merk }}" class="form-control" placeholder="Merk">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga Jakarta:</strong>
                        <input type="number" name="harga_jakarta" value="{{ $product->harga_jakarta }}" class="form-control" placeholder="Harga Jakarta">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga Bali:</strong>
                        <input type="number" name="harga_bali" value="{{ $product->harga_bali }}" class="form-control" placeholder="Harga Bali">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Gambar:</strong>
                        <input type="file" class="form-control" required name="image">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tanggal:</strong>
                        <input id="tanggal" type="text" class="form-control" name="create_date" value="" required autofocus>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>


        </form>
    </div>
</div>
<script type="text/javascript">
    $('#tanggal').datepicker({
       format: 'yyyy-mm-dd',
       autoclose: true,
     });
</script>
@endsection
