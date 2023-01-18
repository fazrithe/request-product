<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head');
</head>
<body>
<div class="wrapper">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><img src="{{ asset('assets/img/logo2.png') }}" alt="User Image" width="50%">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <div class="col mb-4">
                        <div class="text-center text-bold">STOCK OPNAME TOKO</div>
                        <div class="text-right">
                            <label>{{ $data['login_date'] }}</label>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <label id="merk">{{ $data->merk }}</label>
                            </div>
                            <div class="col-6">
                                <label id="barcode">{{ $data->barcode }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label id="nama_barang">{{ $data->nama_barang }}</label>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <p>Toko seduh teh china</p>
                            </div>
                        </div> --}}
                        <hr>
                        <div id="jumlah" style="display: block">
                                <div class="row">
                                    <div class="col-4 text-right">
                                        <label>Stok Toko</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="hidden" id="id" class="form-control" name="id">
                                        <input type="number"  class="form-control" name="stock" value="{{ $total_toko }}" readonly>
                                    </div>
                                    <div class="col-4 text-left">
                                        <label id="satuan">{{ $data->satuan }}</label>
                                    </div>
                                </div>
                        </div>
                        <hr>
                        <div id="jumlah" style="display: block">
                            <div class="row">
                                <div class="col-4 text-right">
                                    <label>Stok Gudang</label>
                                </div>
                                <div class="col-4">
                                    <input type="hidden" id="id" class="form-control" name="id">
                                    <input type="number" class="form-control" name="stock" value="{{ $total_gudang }}" readonly>
                                </div>
                                <div class="col-4 text-left">
                                    <label id="satuan">{{ $data->satuan }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="jumlah" style="display: block">
                            <div class="row">
                                <div class="col-4 text-right">
                                    <label>Total</label>
                                </div>
                                <div class="col-4">
                                    <input type="hidden" id="id" class="form-control" name="id">
                                    <input type="number" class="form-control" name="stock" value="{{ $total }}" readonly>
                                </div>
                                <div class="col-4 text-left">
                                    <label id="satuan">{{ $data->satuan }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="jumlah" style="display: block">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ url('stocks') }}" class="btn btn-primary">Kembali</a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="far fa-circle nav-icon"></i>
                                    {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<footer class="main-footer">
    <strong>@2022<a href="#">Tiang Liong</a>.</strong>
    All rights reserved.
  </footer>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
    jQuery(document).ready(function(){
       jQuery('#btnsearch').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
             url: "{{ route('product.search') }}",
             method: 'post',
             data: {
                kode_barang: jQuery('#kode_barang').val(),
             },
             success: function(result){
                var result = JSON.parse(result);

                if(result.statusCode == 200){
                    jQuery('#merk').html(result.data.merk);
                    jQuery('#nama_barang').html(result.data.nama_barang);
                    jQuery('#barcode').html(result.data.barcode);
                    jQuery('#satuan').html(result.data.satuan);
                    jQuery('#id').val(result.data.id);
                    var x = document.getElementById("jumlah");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                }else{
                    alert("Data tidak ditemukan !");
                }
             }});
          });
       });
</script>
