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
                <div class="card-header text-center">
                    <img src="{{ asset('assets/img/logo2.png') }}" alt="User Image" width="50%">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                <div class="">
                    <a href="#" class="">Permintaan</a>
                </div>
                @endif
                <div class="card-body">
                    <div class="col mb-4">
                        <div class="text-center text-bold">STOCK OPNAME TOKO</div>
                        <div class="text-right">
                            <label>{{ ucfirst(strtolower(trans($data['area']))) }}</label>
                        </div>
                        <div class="text-right">
                            <label>{{ date('Y-m-d H:i:s') }}</label>
                        </div>
                    </div>
                        <div id="sales" style="display: none">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nama Sales') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="sales_name" id="sales_name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama Sales">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Kode Barang') }}</label>
                            <div class="col-md-6">

                                <div class="input-group">
                                    <input type="hidden" name="area" id="area" class="form-control" value="{{ $data['area'] }}">
                                    <input type="hidden" name="login_date" id="login_date" class="form-control" value="{{ $data['login_date'] }}">
                                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Cari Kode Barang/ Barcode">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary" id="btnsearch" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="20" height="20"
                                        viewBox="0 0 50 50"
                                        style=" fill:#000000;"><path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div align="center" id="or">
                            Or
                         </div>
                         <br>
                         <div align="center">
                             <img src="{{ asset('assets/img/scanner.png') }}" width="30%" onclick="scanner()" id="scanner" style="margin: auto">
                         </div>
                         <div align="center" id="display" style="display:none">
                             <div id="qr-reader" class="text-center" style="margin: auto"></div>
                         </div>
                         <br>
                        <div>
                            <div><img id="image" src="" width="30%" style="margin: auto"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label id="merk"></label>
                            </div>
                            <div class="col-6">
                                <label id="barcode"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label id="kode_barang_1"></label>
                                <p id="nama_barang"></p>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <p>Toko seduh teh china</p>
                            </div>
                        </div> --}}
                        <hr>
                        <div id="jumlah" style="display: none">
                            <form method="POST" action="{{ route('product.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-4 text-right">
                                        <label>Jumlah :</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="hidden" name="update_date" class="form-control" value="{{ $data['login_date'] }}">
                                        <input type="hidden" id="id" class="form-control" name="id">
                                        <input type="number" class="form-control" id="stok" name="stock">
                                    </div>
                                    <div class="col-4 text-left">
                                        <label id="satuan"></label>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col">
                                        <a href="#" class="btn btn-success">Scan</a>
                                    </div>
                                    <div class="col">
                                        <Button class="btn btn-primary">Submit</Button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="text-right">
                    <a href="{{ route("product.show") }}" class="btn btn-primary">Permintaan</a>
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
                login_date: jQuery('#login_date').val(),
                area: jQuery('#area').val(),
             },
             success: function(result){
                var result = JSON.parse(result);
                // console.log(result.data.kode_barang);
                if(result.statusCode == 200){
                    console.log(result.stok);
                    jQuery('#merk').html(result.data.merk);
                    jQuery('#nama_barang').html(result.data.nama_barang);
                    jQuery('#kode_barang_1').html(result.data.kode_barang);
                    jQuery('#barcode').html(result.data.barcode);
                    jQuery('#satuan').html(result.data.satuan);
                    jQuery('#id').val(result.data.id);
                    jQuery('#stok').val(result.stok);
                    var x = document.getElementById("jumlah");
                    var display = document.getElementById("display");
                    var scanner = document.getElementById("scanner");
                    var sales = document.getElementById("sales");
                    var or      = document.getElementById("or");
                    var image1 = "https://tianliong.co.id/info/assets/img/products/"+result.data.gambar;
                    console.log(image1);
                        x.style.display = "block";
                        display.style.display = "none";
                        scanner.style.display = "none";
                        sales.style.display = "block";
                        or.style.display = "none";
                        let image = document.getElementById("image");
                        image.src =
                        "https://tianliong.co.id/info/assets/img/products/"+result.data.gambar

                        document.getElementById("btnID")
                                .style.display = "none";

                }else{
                    alert("Data tidak ditemukan !");
                }
             }});
          });
       });
</script>
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<script>
function scanner(){
    var x = document.getElementById("display");
    var y = document.getElementById("scanner");
    var or = document.getElementById("or");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
            or.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "block";
            or.style.display = "block";
        }
    let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
    let minEdgePercentage = 0.7; // 70%
    let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
    let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
    return {
        width: qrboxSize,
        height: qrboxSize
    };
}


const html5QrCode = new Html5Qrcode("qr-reader");
const qrCodeSuccessCallback = (decodedText, decodedResult) => {
    /* handle success */
    console.log(`Scan result: ${decodedText}`, decodedResult);
    document.getElementById('kode').value=decodedText;
    // ...
    html5QrcodeScanner.clear();
};
const config = { fps: 10, qrbox: 250 };

// Select front camera or fail with `OverconstrainedError`.
// html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
html5QrCode.start({ facingMode: { exact: "user"} }, config, qrCodeSuccessCallback);

}
</script>
