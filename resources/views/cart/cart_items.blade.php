@extends('master')
@section('content')

<div class="container padding-bottom-3x mb-1">
    <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
    <!-- Alert-->
    @if (session('message'))
        <div class="alert alert-info alert-dismissible fade show text-center" style="margin-bottom: 30px;">
            <span class="alert-close" data-dismiss="alert"></span>
            {{ session('message') }}
        </div>
    @endif
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">
                        
                        <form action="{{route('cart.clear')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Clear cart </button>
                        </form> 
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($cartItem as $item)    
                <tr>
                    <td>
                        <div class="product-item">
                            
                            <img src="{{ asset('images/'.$item->options['image_path'])}}" alt="{{$item->name}}">
                            
                            <div class="product-info">
                                <h4 class="flex-column ms-4">{{$item->name}}</h4>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">
                        {{$item->qty}}
                    </td>
                    <td class="text-center text-lg text-medium">{{$item->price}}</td>
                    <td class="text-center text-lg text-medium">{{$item->qty * $item->price}}</td>
                    <td class="text-center">
                        <form action="{{ route('cart.remove', ['productId' => $item->rowId]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary me-md-2">Remove </button>
                        </form> 
                    </td>
                </tr>
            @endforeach            
            </tbody>
        </table>
    </div>
    <div class="row justify-content-between">
        <div class="col">
            <a class="btn btn-outline-secondary" href="{{url('products')}}">
                <i class="icon-arrow-left"></i>&nbsp;Back to Shopping
            </a>
        </div>
        <div class="col">
            
            <form action="" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-primary me-md-2">Checkout</button>
            </form> 
        </div>
        <div class="col text-lg">Total: 
            <span class="text-medium">{{$subtotal}}</span>
        </div>
    </div> 
</div>
@endsection

        
