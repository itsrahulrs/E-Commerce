@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('My Cart') }}
                    </h3>
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> {{ __('Go Back') }}</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="2">{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Subtotal') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                
                        <?php $total = 0 ?>
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $product)
                
                                <?php $total += $product['price'] * $product['quantity'] ?>
                
                                <tr>
                                    <td>
                                        <img src="{{ asset('/images/'.$product['photo']) }}" width="100px">
                                    </td>
                                    <td style="max-width: 250px">
                                        <h4 class="card-title fs-1 text-black-50">{{ $product['name'] }} </h4>
                                        <p class="card-text">{{ $product['description'] }}</p>
                                    </td>
                                    <td>{{ $product['price'] }}</td>
                                    <td>
                                        <form action="{{ route('updateCart',$id) }}" method="Post">
                                        <input type="number" name="quantity" value="{{ $product['quantity'] }}" class="form-control" />
                                        <input type="hidden" name="id" value="{{ $id }}" class="form-control" />
                                    </td>
                                    <td class="text-center">{{ $product['price'] * $product['quantity'] }}</td>
                                    <td>
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning">{{ __('Update') }}</button>
                                        </form>
                                        <form action="{{ route('removeFromCart',$id) }}" method="Post">
                                            <input type="hidden" name="id" value="{{ $id }}" class="form-control" />
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                
                        </tbody>
                        <tfoot>
                       
                        <tr>
                            <td><a href="{{ route('checkout') }}" class="btn btn-success "><i class="fa fa-angle-left"></i> {{ __('Proceed To Checkout') }}</a></td>
                            <td colspan="4" class="hidden-xs"></td>
                            <td class="hidden-xs text-center">
                                <strong>{{ __('Total') }} {{ $total }}</strong> <br>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection