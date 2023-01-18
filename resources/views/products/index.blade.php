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
        <div class="pull-right">
            @can('product-create')
            <a class="btn btn-primary" href="{{ route('products.create') }}"> Create Barang</a>
            @endcan
        </div>
        <hr>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Barcode</th>
            <th>Nama Barang</th>
            <th width="">Action</th>
        </tr>
        </thead>
            @foreach($products as $item)
            <tr>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->barcode }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td width=""> <a class="btn btn-info" href="{{ route('products.show',$item->id) }}">Show</a>
                <a class="btn btn-success" href="{{ route('products.edit',$item->id) }}">Edit</a>
                 {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $item->id],'style'=>'display:inline']) !!}
                     {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                 {!! Form::close() !!}</td>
            </tr>
            @endforeach
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
