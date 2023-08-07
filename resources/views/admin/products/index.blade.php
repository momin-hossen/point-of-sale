@extends('layouts.dashboard_app')

@section('dashboard_content')

<div class="container-fluid">
    <div class="row">
      
        <div class="col-12 m-auto py-5 mb-5">
            <a class="btn btn-primary btn-sm m-3" href="{{ url('products/create') }}">Product Create</a>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Product List</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount Type</th>
                        <th>Discount Amount</th>
                        <th>Sale Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($products as $product)
                      <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->onetoonerelationwithcategorytable->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_type }}</td>
                        <td>{{ $product->discount_amount }}</td>
                        <td>{{ $product->sale_price }}</td>
                        <td><img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->name }}" width="100"></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
                              </form>
                              
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
        </div>
    </div>
</div>

@endsection