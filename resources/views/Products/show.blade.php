@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Show Product') }}
                    </h3>
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> {{ __('Go Back') }}</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div style="width: 18rem;">
                        <img src="{{ asset('/images/'.$product->image) }}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="card-title fs-1 text-black-50">{{ $product->name }} </h4>
                            <span class="font-monospace fs-4 text-black">{{ $product->price }}</span>
                            <p class="card-text">{{ $product->description }}</p>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection