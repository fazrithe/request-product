@extends('layouts.app')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Barang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{ route('product.export') }}">
                @csrf
                <div class="form-group row">
                    <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                    <div class="col-md-6">
                        <input id="tanggal" type="text" class="date1 form-control" name="date" value="" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10 text-right">
                    <button class="btn btn-success">Export Barang</button>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-6">
                <form method="POST" action="{{ route('product.showDate') }}">
                @csrf
                <div class="form-group row">
                    <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                    <div class="col-md-6">
                        <input id="tanggal" type="text" class="date1 form-control" name="date" value="" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10 text-right">
                    <button class="btn btn-success">Tampil Barang</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<script type="text/javascript">
    $('.date1').datepicker({
       format: 'yyyy-mm-dd',
       autoclose: true,
     });
</script>
@endsection
