@extends('layouts.app')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Roles</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="pull-right">
            @can('role-create')
                <a class="btn btn-primary" href="{{ route('roles.create') }}"> Create New Role</a>
                @endcan
            </div>
        <hr>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                @can('role-edit')
                    <a class="btn btn-success" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                @endcan
                @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
