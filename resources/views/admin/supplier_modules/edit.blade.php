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
              <h3>Supplier Modules Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('supplier_modules') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Supplier Modules View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Supplier Modules Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('supplier_modules.update', $supplierModule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control quantity" name="name" value="{{ $supplierModule->name }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control quantity" name="phone" value="{{ $supplierModule->phone }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control quantity" name="email" value="{{ $supplierModule->email }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option>--Select One--</option>
                            <option @selected($supplierModule->status == 1) value="1">One</option>
                            <option @selected($supplierModule->status == 2) value="2">Two</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control quantity" name="address" value="{{ $supplierModule->address }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control quantity" name="password" value="{{ $supplierModule->password }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Total Price</label>
                        <input type="text" class="form-control quantity" name="total_bill" value="{{ $supplierModule->total_bill }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="text" class="form-control quantity" name="due_amount" value="{{ $supplierModule->due_amount }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="text" class="form-control quantity" name="paid_amount" value="{{ $supplierModule->paid_amount }}">
                    </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Suppliew Modules</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
