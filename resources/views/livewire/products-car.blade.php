<div>
    <div class="container">
        <div class="card ">
        <img class="card-img-top" src="{{ asset('images/'.$product->image_path)}}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$product->product_name}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <p class="card-text"><small class="text-muted">UGX{{$product->price}}</small></p>
            @if ($cart->where('id', $product->id)->count())
                incart
            @else
            <form action="{{ route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value = "{{ $product->id }}">
                <input type="number" value="1" name="quantity" class="text-sm sm:text-base"/>
                <button type="submit" class="btn btn-primary btn-lg">Add to cart</button>
            </form>
            @endif
        </div>


    </div>
        
    </div>
    
</div>
