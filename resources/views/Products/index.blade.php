@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Products') }}
                    </h3>
                    @auth
                        @role('Employee')
                            <a class="btn btn-primary" href="{{ route('products.create') }}"> {{ __('Create product') }}</a>
                        @endrole
                    @endauth
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-sm-4 col-md-6 col-lg-4">
                            <a class="text-decoration-none" href="{{ route('products.show',$product->id) }}">
                                <div class="card">
                                    <img src="{{ asset('/images/'.$product->image) }}" class="p-3" style="width: fit-content;max-height: 150px;">
                                    <div class="card-body">
                                        <h4 class="card-title fs-1 text-black-50">{{ $product->name }} </h4>
                                        <span class="font-monospace fs-4 text-black">{{ $product->price }}</span>
                                        <p class="card-text mb-3">{{ $product->description }}</p>
                                        <form action="{{ route('products.destroy',$product->id) }}" method="Post">
                                            @auth
                                                @role('Customer')
                                                    <a href="{{ route('addToCart',$product->id) }}" class="btn btn-primary">{{ __('Add to Cart') }}</a>
                                                @endrole
                                                @role('Admin')
                                                    @if ($product->status == 0)
                                                        <a class="btn btn-info" href="{{ route('products.approve',$product->id) }}">{{ __('Approve') }}</a>
                                                    @endif
                                                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">{{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                                @endrole
                                            @else
                                                <a href="{{ route('addToCart',$product->id) }}" class="btn btn-primary">{{ __('Add to Cart') }}</a>
                                            @endauth
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection