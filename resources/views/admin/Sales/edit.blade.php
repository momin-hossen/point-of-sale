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
              <h3>Sale Edit</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('sales') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Sale View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sale Edit</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Customer</label>
                          <select class="form-select" name="customer_id" id="customer_id">
                            <option>--Select One--</option>
                            @foreach ($active_customers as $active_customer)
                                <option {{ ($active_customer->id == $sale_info->customer_id) ? "selected":"" }} value="{{ $active_customer->id }}">{{ $active_customer->name }}</option>
                            @endforeach
                          </select>
                    </div>
                  <div class="mb-3">
                    <label class="form-label">Product</label>
                      <select class="form-select" name="product_id" id="product_id">
                        <option>--Select One--</option>
                        @foreach ($active_products as $active_product)
                            <option {{ ($active_product->id == $sale_info->product_id) ? "selected":"" }} value="{{ $active_product->id }}">{{ $active_product->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control quantity" name="quantity" value="{{ $sale_info->quantity }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select">
                        <option value="1">-Select-</option>
                        <option @selected($sale_info->discount_type == 'percentage') value="percentage">Percentage</option>
                        <option @selected($sale_info->discount_type == 'fixed') value="fixed">Fixed</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Sale Price</label>
                    <input type="number" class="form-control sale_price" name="sale_price" value="{{ $sale_info->sale_price }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Total Bill</label>
                    <input type="number" class="form-control total_bill" name="total_bill" value="{{ $sale_info->total_bill }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Paid Amount</label>
                    <input type="number" class="form-control paid_amount" name="paid_amount" value="{{ $sale_info->paid_amount }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Due Amount</label>
                    <input type="number" class="form-control due_amount" name="due_amount" value="{{ $sale_info->due_amount }}">
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Update</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @push('js')
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
            $('.total_bill').val(sale_price * quantity);
        }
        $('.paid_amount').on('input', function() {
            calculate();
        });
        function calculate() {
            let total_bill = $('.total_bill').val();
            let paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total_bill - paid_amount);
        }
    </script>
@endpush --}}
