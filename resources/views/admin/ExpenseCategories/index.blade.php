@extends('layouts.dashboard_app')

@section('dashboard_content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto mb-5">
          <div class="row justify-content-between">
            <div class="col mt-3">
              <h3>Expense Category List</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm my-3" href="{{ url('expense_categories/create') }}"><i class='menu-icon tf-icons bx bx-plus-circle'></i> Expense Category Create</a>
            </div>
          </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-body">
                  <div class="row justify-content-between">
                    <div class="col-sm-6">
                        <h5>Expense Category List</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="button-addon2" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search-alt-2'></i></button>
                              </div>
                        </form>
                    </div>
                  </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($expense_categories as $expense_category)
                      <tr>
                        <td>{{ $expense_category->id }}</td>
                        <td>{{ $expense_category->name }}</td>
                        <td>{{ $expense_category->description }}</td>
                        <td>{{ $expense_category->status }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('expense_categories.edit', $expense_category->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <form action="{{ route('expense_categories.destroy', $expense_category->id) }}" method="POST">
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