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
        <div class="col-12 m-auto">
          <div class="row justify-content-between">
            <div class="col mt-3">
              <h3>Product Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('products') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Product View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                          <option>--Select One--</option>
                          @foreach ($active_categories as $active_category)
                              <option value="{{ $active_category->id }}">{{ $active_category->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Price</label>
                      <input type="text" class="form-control" name="price">
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Discount Type</label>
                      <select name="discount_type" class="form-select">
                          <option>--Select One--</option>
                          <option value="1">Percentage</option>
                        <option value="2">Fixed</option>
                      </select>
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Discount Amount</label>
                      <input type="text" class="form-control" name="discount_amount">
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Sale Price</label>
                      <input type="text" class="form-control" name="sale_price">
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Image:</label>
                      <input type="file" class="form-control" name="image"/>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Product</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection