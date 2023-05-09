@extends('master')
@section('content')
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="ccontaier-fluid bg-trasparent my-4 p-3r">
    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
        @foreach($data as $product)
            <div class="col ">
                <div class="card h-90  shadow-sm" style="width: 18rem, height: 350px;">
                <img  class="card-img-top" src="{{ asset('images/'.$product->image_path)}}"  alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$product->product_name}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text"><small class="text-muted">UGX{{$product->price}}</small></p>
                    <a href="/products/{{$product->id}}" class="btn btn-primary">Get Details</a>
                </div>
            </div>

            </div>
            
        @endforeach
        
    </div> 

    
</div> 



    
    


@endsection