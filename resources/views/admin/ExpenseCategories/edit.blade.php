@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto">
          <div class="row justify-content-between">
            <div class="col mt-3">
              <h3>Expense Category Edit</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('expense_categories') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Expense Category View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Expense Category Edit</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('expense_categories.update', $expenseCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $expenseCategory->name }}" class="form-control" placeholder="Enter your name" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                      <option>{{ $expenseCategory->status }}</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                      class="form-control"
                      placeholder="Enter your description"
                      name="description"
                    >{{ $expenseCategory->description }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bxs-save' ></i>Update</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection