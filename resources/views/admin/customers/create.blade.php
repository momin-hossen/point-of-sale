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
              <h3>Customer Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('customers') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Customer View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('customers.store') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control quantity" name="name">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control quantity" name="phone">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control quantity" name="email">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option>--Select One--</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control quantity" name="address">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control quantity" name="password">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Total Bill</label>
                        <input type="number" class="form-control quantity" name="total_bill">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="number" class="form-control quantity" name="due_amount">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="number" class="form-control quantity" name="paid_amount">
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
