@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Update role') }}
                    </h3>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Back to List') }}</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                <div class="form-group">
                                    <strong>{{ __('Name:') }}</strong>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" autocomplete="name" autofocus>
                        
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                <label for="permissions" class="form-label">Assign Permissions</label>
                
                                <table class="table table-striped">
                                    <thead>
                                        <th scope="col" width="1%"></th>
                                        <th scope="col" width="20%">Name</th>
                                        <th scope="col" width="1%">Guard</th> 
                                    </thead>
                
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" 
                                                name="permission[{{ $permission->name }}]"
                                                value="{{ $permission->name }}"
                                                class='permission'
                                                {{ in_array($permission->name, $rolePermissions) 
                                                    ? 'checked'
                                                    : '' }}>
                                            </td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->guard_name }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                <div class="form-group justify-content-end d-flex">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Create Role">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection