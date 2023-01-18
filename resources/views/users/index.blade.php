@extends('layouts.app')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data User</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.create') }}"> Create New User</a>
        </div>
        <hr>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $key => $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td>
               <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
               <a class="btn btn-success" href="{{ route('users.edit',$user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
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
