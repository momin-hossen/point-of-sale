@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto">
          <a class="btn btn-primary btn-sm m-3" href="{{ url('expenses') }}">Expense View</a>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Expense Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('expenses.store') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label class="form-label">Expense Category</label>
                      <select class="form-select" name="expense_category_id">
                        <option>--Select One--</option>
                        @foreach ($active_expense_categories as $active_expense_category)
                            <option value="{{ $active_expense_category->id }}">{{ $active_expense_category->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Expense Date</label>
                    <input type="date" name="expense_date" class="form-control" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                      class="form-control"
                      placeholder="Enter your description"
                      name="description"
                    ></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Expense</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection