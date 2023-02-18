@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Show Role') }}
                    </h3>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Go Back') }}</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div>
                        <div class="card-body">
                            <h4 class="card-title font-monospace fs-1 text-black">Role : <strong>{{ ucfirst($role->name) }}</strong> </h4>
                            <span class="fs-5 text-black">Assigned permissions</span>

                            <table class="table table-striped">
                                <thead>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="1%">Guard</th> 
                                </thead>
                
                                @foreach($rolePermissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <form action="{{ route('roles.destroy',$role->id) }}" method="Post">
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection