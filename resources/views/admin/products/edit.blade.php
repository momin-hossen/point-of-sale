@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12 m-auto py-5">
          <a class="btn btn-primary btn-sm m-3" href="{{ url('products') }}">Product View</a>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                      <select class="form-select" name="category_id">
                        <option>--Select One--</option>
                        @foreach ($active_categories as $active_category)
                            <option {{ ($active_category->id == $product_info->category_id) ? "selected":"" }} value="{{ $active_category->id }}">{{ $active_category->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ $product_info->name }}" name="name">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" value="{{ $product_info->price }}" name="price">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select"  value="">
                        <option>{{ $product_info->discount_type }}</option>
                        <option value="1">Percentage</option>
                      <option value="2">Fixed</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Discount Amount</label>
                    <input type="text" class="form-control" name="discount_amount" value="{{ $product_info->discount_amount }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Sale Price</label>
                    <input type="text" class="form-control" name="sale_price" value="{{ $product_info->sale_price }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Image:</label>
                    <input type="file" class="form-control" name="image"/>
                    <img src="{{ asset('product/'.$product_info->image) }}" alt="{{ $product->name }}" width="100">
                  </div>
                  <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection