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
                <button class="btn btn-success add-button">+ Add</button>
            </div>
              <div class="card-body">
                <form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><strong>Sr. No.</strong></th>
                                <th><strong>Supplier</strong></th>
                                <th><strong>Product</strong></th>
                                <th><strong>Quantity</strong></th>
                                <th><strong>Discount Type</strong></th>
                                <th><strong>Sale Price</strong></th>
                                <th><strong>Total Bill</strong></th>
                                <th><strong>Paid Amount</strong></th>
                                <th><strong>Due Amount</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="ta-row-1 total-row">
                                <td>1</td>
                                <td><select class="form-select" name="supplier_id[]" id="supplier_id">
                                    <option>--Select One--</option>
                                    @foreach ($active_suppliers as $active_supplier)
                                        <option value="{{ $active_supplier->id }}">{{ $active_supplier->name }}</option>
                                    @endforeach
                                  </select>
                                </td>
                                <td>
                                    <select class="form-select" name="product_id[]" id="product_id" data-current_row="1">
                                        <option>--Select One--</option>
                                        @foreach ($active_products as $active_product)
                                            <option data-sale_price="{{ $active_product->sale_price }}" value="{{ $active_product->id }}">{{ $active_product->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control quantity" name="quantity[]">
                                </td>
                                <td>
                                    <select name="discount_type[]" class="form-select">
                                        <option>--Select One--</option>
                                        <option value="percentage">Percentage</option>
                                      <option value="fixed">Fixed</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control sale_price row-1" name="sale_price[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control total_bill" name="total_bill[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control paid_amount" name="paid_amount[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control due_amount" name="due_amount[]">
                                </td>
                                <td><button class="btn btn-danger close-item">x</button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class=' menu-icon tf-icons bx bx-save' ></i> Purchase</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        $(document).on('change','#product_id', function() {
            let currentRow = $(this).data('current_row');
            let sale_price = $(this).find('option:selected').data('sale_price');
            console.log(currentRow)
            $('.sale_price.row-'+currentRow).val(sale_price);
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


        $(document).on('click', '.add-button', function() {
            const original_input = $('.total-row').length+1;
            $('table tbody').append('<tr class="ta-row-'+original_input+' total-row"><td>'+original_input+'</td><td><select class="form-select" name="supplier_id[]" id="supplier_id"><option>--Select One--</option>@foreach ($active_suppliers as $active_supplier)<option value="{{ $active_supplier->id }}">{{ $active_supplier->name }}</option>@endforeach</select></td><td><select class="form-select" data-current_row="'+original_input+'" name="product_id[]" id="product_id"><option>--Select One--</option>@foreach ($active_products as $active_product)<option data-sale_price="{{ $active_product->sale_price }}" value="{{ $active_product->id }}">{{ $active_product->name }}</option>@endforeach</select></td><td><input type="number" class="form-control quantity" name="quantity[]"></td><td><select name="discount_type[]" class="form-select"><option>--Select One--</option><option value="percentage">Percentage</option><option value="fixed">Fixed</option></select></td><td><input type="number" class="form-control sale_price row-'+original_input+'" name="sale_price[]"></td><td><input type="number" class="form-control total_bill" name="total_bill[]"></td><td><input type="number" class="form-control paid_amount" name="paid_amount[]"></td><td><input type="number" class="form-control due_amount" name="due_amount[]"></td><td><button class="btn btn-danger close-item">x</button></td></tr>@push("js")<script>$("#product_id").on("change", function() {let sale_price = $("#product_id option:selected").data("sale_price");$(".sale_price").val(sale_price);calculateTotal();});$(".quantity").on("input", function() {calculateTotal();});function calculateTotal() {let sale_price = $(".sale_price").val();let quantity = $(".quantity").val();$(".total_bill").val(sale_price * quantity);}$(".paid_amount").on("input", function() {calculate();});function calculate() {let total_bill = $(".total_bill").val();let paid_amount = $(".paid_amount").val();$(".due_amount").val(total_bill - paid_amount);}</script>@endpush');
        })

        $(document).on('click', '.close-item', function() {
            $(this).closest('.total-row').remove();
        })
    </script>
@endpush
