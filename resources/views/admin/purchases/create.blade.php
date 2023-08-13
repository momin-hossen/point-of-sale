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
              <h3>Purchase Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('purchases') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Purchase View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Supplier</label>
                            <select class="form-select" name="supplier_id" id="supplier_id">
                              <option>--Select One--</option>
                              @foreach ($active_suppliers as $active_supplier)
                                  <option value="{{ $active_supplier->id }}">{{ $active_supplier->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Product</label>
                          <select class="form-select" name="product_id" id="product_id">
                            <option>--Select One--</option>
                            @foreach ($active_products as $active_product)
                                <option data-sale_price="{{ $active_product->sale_price }}" value="{{ $active_product->id }}">{{ $active_product->name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control quantity" name="quantity">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-select">
                            <option>--Select One--</option>
                            <option value="1">Percentage</option>
                          <option value="2">Fixed</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Sale Price</label>
                        <input type="text" class="form-control sale_price" name="sale_price">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Total Price</label>
                        <input type="text" class="form-control total_price" name="total_price">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="text" class="form-control paid_amount" name="paid_amount">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="text" class="form-control due_amount" name="due_amount">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Purchase</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        $('#product_id').on('change', function() {
            let sale_price = $('#product_id option:selected').data('sale_price');
            $('.sale_price').val(sale_price);
            calculateTotal();
        });

        $('.quantity').on('input', function() {
            calculateTotal();
        });

        function calculateTotal() {
            let sale_price = $('.sale_price').val();
            let quantity = $('.quantity').val();
            $('.total_price').val(sale_price * quantity);
        }
        $('.paid_amount').on('input', function() {
            calculate();
        });
        function calculate() {
            let total_price = $('.total_price').val();
            let paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total_price - paid_amount);
        }
    </script>
@endpush
