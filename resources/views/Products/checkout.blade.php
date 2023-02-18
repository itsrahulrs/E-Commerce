@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('placeOrder') }}" method="POST">
                @csrf
                <?php $total = 0 ?>
                <?php $item_count = 0 ?>
                @foreach(session('cart') as $id => $product)
                    <?php $total += $product['price'] * $product['quantity'] ?>
                    <?php $item_count += $product['quantity'] ?>
                @endforeach
                <input type="hidden" name="grand_total" value="{{ $total }}">
                <input type="hidden" name="item_count" value="{{ $item_count }}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">{{ __('Billing Details') }}</h4>
                            </header>
                            <div class="row p-3">
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Name:') }}</strong>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Email:') }}</strong>
                                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                        <small class="form-text text-muted">{{ __('We will never share your email with anyone else.') }} </small>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Address:') }}</strong>
                                        <textarea name="address" id="address" cols="30" rows="3"class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address') }}</textarea>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('City:') }}</strong>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="City">
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Country:') }}</strong>
                                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" placeholder="Country">
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Postal Code:') }}</strong>
                                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" placeholder="Postal Code">
                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <strong>{{ __('Phone Number:') }}</strong>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone Number">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">{{ __('Your Order') }}</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>{{ __('Total cost:') }} </dt>
                                            <dd class="text-right h5 b"> {{ $total }} </dd>
                                        </dl>
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">{{ __('Place Order') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection