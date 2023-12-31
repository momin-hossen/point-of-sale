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
              <h3>Supplier Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('suppliers') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Supplier View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Supplier Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control quantity" name="name" value="{{ $supplier->name }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control quantity" name="phone" value="{{ $supplier->phone }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control quantity" name="email" value="{{ $supplier->email }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option>--Select One--</option>
                            <option @selected($supplier->status == 'active') value="active">Active</option>
                            <option @selected($supplier->status == 'inactive') value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control quantity" name="address" value="{{ $supplier->address }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control quantity" name="password" value="{{ $supplier->password }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Total Bill</label>
                        <input type="number" class="form-control quantity" name="total_bill" value="{{ $supplier->total_bill }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="number" class="form-control quantity" name="due_amount" value="{{ $supplier->due_amount }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="number" class="form-control quantity" name="paid_amount" value="{{ $supplier->paid_amount }}">
                    </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Suppliew </button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
