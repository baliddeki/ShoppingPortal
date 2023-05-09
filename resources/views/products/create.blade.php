@extends('master')
@section('content')
<div class="container">
  <!-- Content here -->

<form  method="POST" action="{{route('products.store')}} " enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleFormControlFile">Image</label>
    <input type="file" name="product_image" class="form-control-file" >
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput">product name</label>
    <input type="text" class="form-control"name="product_name" id="formGroupExampleInput" placeholder="Example input">
  </div>
  <div class="form-group ">
    <label for="formGroupExampleInput">category</label>
    <input type="text" class="form-control" name="category" placeholder="prduct category">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">price</label>
    <input type="number" class="form-control" name="price" placeholder="price">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">quantity</label>
    <input type="number" class="form-control" name="quantity" placeholder="quantity">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">description</label>
    <input type="text" class="form-control" name="description" placeholder="product description">
  </div>

  <button type="submit" name ="submit" class="btn btn-primary">Create product</button>
</form>

</div>
@endsection