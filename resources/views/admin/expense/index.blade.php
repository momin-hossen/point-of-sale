@extends('layouts.dashboard_app')

@section('dashboard_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto mb-5">
            <a class="btn btn-primary btn-sm m-3" href="{{ route('expenses.create') }}">Expense Create</a>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Unit's List</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Expense Category</th>
                        <th>User ID</th>
                        <th>Expense Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($expenses as $expense)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $expense->onetoonerelationwithexpensecategorytable->name }}</td>
                        <td>{{ Auth::user()->id }}</td>
                        <td>{{ $expense->expense_date }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('expenses.edit', $expense->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
                              </form>
                              
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
        </div>
    </div>
</div>

@endsection