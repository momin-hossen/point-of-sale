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
              <h3>Customer Modules Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('customer_modules') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Customer Modules View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Modules Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('customer_modules.update', $customerModule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control quantity" name="name" value="{{ $customerModule->name }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control quantity" name="phone" value="{{ $customerModule->phone }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control quantity" name="email" value="{{ $customerModule->email }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option>--Select One--</option>
                            <option @selected($customerModule->status == 1) value="1">One</option>
                            <option @selected($customerModule->status == 2) value="2">Two</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control quantity" name="address" value="{{ $customerModule->address }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control quantity" name="password" value="{{ $customerModule->password }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Total Price</label>
                        <input type="text" class="form-control quantity" name="total_bill" value="{{ $customerModule->total_bill }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="text" class="form-control quantity" name="due_amount" value="{{ $customerModule->due_amount }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="text" class="form-control quantity" name="paid_amount" value="{{ $customerModule->paid_amount }}">
                    </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Customer Modules</button>
                  </div>
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
