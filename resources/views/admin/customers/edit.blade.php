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
              <h3>Customer Edit</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('customers') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Customer View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Edit</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control " name="name" value="{{ $customer->name }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control " name="phone" value="{{ $customer->phone }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control " name="email" value="{{ $customer->email }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option>--Select One--</option>
                            <option @selected($customer->status == 'active') value="active">Active</option>
                            <option @selected($customer->status == 'inactive') value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $customer->address }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="{{ $customer->password }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Total Bill</label>
                        <input type="number" class="form-control" name="total_bill" value="{{ $customer->total_bill }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="number" class="form-control " name="due_amount" value="{{ $customer->due_amount }}">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="number" class="form-control" name="paid_amount" value="{{ $customer->paid_amount }}">
                    </div>
                  <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i> Customer</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
