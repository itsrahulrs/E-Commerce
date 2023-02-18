@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>
                        {{ __('All Orders') }}
                    </h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table id="order" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Order Number') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Items') }}</th>
                                <th>{{ __('View') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->order_number}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>{{$order->grand_total}}</td>
                                    <td>{{$order->item_count}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('order.show',$order->id) }}">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection