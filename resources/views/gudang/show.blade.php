<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head');
</head>
<body>
<div class="wrapper">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                        <div class="text-left">
                            <label>{{ date('Y-m-d H:i:s') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Sales</th>
                                <th scope="col">Permintaan Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Jam Minta</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Jawaban Gudang</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($requestProducts as $index => $item)
                              <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->request_time }}</td>
                                <td>{{ $item->answare_time }}</td>
                                <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalJawab">
                                    Jawab
                                </a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                        </table>
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
