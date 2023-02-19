@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Order Details') }}
                    </h3>
                    @auth
                        @role('Admin')
                        <a class="btn btn-primary" href="{{ route('Orders.index') }}"> {{ __('Go Back') }}</a>
                        @endrole
                        @role('Customer')
                        <a class="btn btn-primary" href="{{ route('myOrders') }}"> {{ __('Go Back') }}</a>
                        @endrole
                    @endauth
                </div>

                <div class="card-body">
                    <dl class="dlist-align">
                        <dt>{{ __('Order Number:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->order_number }} </dd>
                        <dt>{{ __('Status:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->status }} </dd>
                        <dt>{{ __('Total Amount:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->grand_total }} </dd>
                        <dt>{{ __('Total Products:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->item_count }} </dd>
                        <dt>{{ __('Order Placed At:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->created_at }} </dd>

                        <h4 class="text-danger mt-4 mb-3">{{ __('Billing Info') }}</h4>

                        <dt>{{ __('Name:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->name }} </dd>
                        <dt>{{ __('Address:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->address }} </dd>
                        <dt>{{ __('City:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->city }} </dd>
                        <dt>{{ __('Country:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->country }} </dd>
                        <dt>{{ __('Postal Code:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->post_code }} </dd>
                        <dt>{{ __('Phone Number:') }} </dt>
                        <dd class="text-right h5 b"> {{ $order->phone_number }} </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('Ordered Items') }}
                    </h3>
                    @auth
                        @role('Admin')
                        @if ($order->status == 'pending')
                        <a class="btn btn-primary" href="{{ route('order.completed',$order->id) }}"> {{ __('Change status to delevered') }}</a>
                        @endif
                        @endrole
                    @endauth
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($order_items as $item)
                        <div class="col-sm-4 col-md-6 col-lg-4">
                            <div class="card">
                                <img src="{{ asset('/images/'.$item->product->image) }}" class="p-3" style="width: fit-content;max-height: 150px;">
                                <div class="card-body">
                                    <h4 class="card-title fs-3 text-black-50">{{ $item->product->name }} </h4>
                                    <span class="font-monospace fs-5 text-black"><strong>{{ __('Quantity:') }} </strong>{{ $item->quantity }}</span><br>
                                    <span class="font-monospace fs-5 text-black"><strong>{{ __('Price:') }} </strong>{{ $item->product->price }}</span><br>
                                    <span class="font-monospace fs-5 text-black"><strong>{{ __('Total:') }} </strong>{{ $item->product->price * $item->quantity }}</span><br>
                                    <p class="card-text">{{ $item->product->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection