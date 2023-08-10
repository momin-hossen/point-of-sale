@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto">
          <div class="row justify-content-between">
            <div class="col mt-3">
              <h3>Purchase Edit</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('purchases') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Purchase View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product Edit</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="mb-3">
                    <label class="form-label">Product</label>
                      <select class="form-select" name="product_id" id="product_id">
                        <option>--Select One--</option>
                        @foreach ($active_products as $active_product)
                            <option {{ ($active_product->id == $purchase_info->product_id) ? "selected":"" }} value="{{ $active_product->id }}">{{ $active_product->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="text" class="form-control quantity" name="quantity" value="{{ $purchase_info->quantity }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select">
                        <option>{{ $purchase_info->discount_type }}</option>
                        <option value="1">Percentage</option>
                      <option value="2">Fixed</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Sale Price</label>
                    <input type="text" class="form-control sale_price" name="sale_price" value="{{ $purchase_info->sale_price }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Total Price</label>
                    <input type="text" class="form-control total_price" name="total_price" value="{{ $purchase_info->total_price }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Paid Amount</label>
                    <input type="text" class="form-control paid_amount" name="paid_amount" value="{{ $purchase_info->paid_amount }}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Due Amount</label>
                    <input type="text" class="form-control due_amount" name="due_amount" value="{{ $purchase_info->due_amount }}">
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
@endpush --}}