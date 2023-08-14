@extends('layouts.dashboard_app')

@section('dashboard_content')

<div class="container-fluid">
    <div class="row">

        <div class="col-12 m-auto mb-5">
          <div class="row justify-content-between">
            <div class="col mt-3">
              <h3>Supplier List</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('suppliers/create') }}"><i class='menu-icon tf-icons bx bx-plus-circle'></i> Supplier Create</a>
            </div>
          </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
              <div class="card-body">
                <div class="row justify-content-between">
                  <div class="col-sm-6">
                      <h5>Supplier List</h5>
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
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>Total Bill</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($suppliers as $supplier)
                      <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->status }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->password }}</td>
                        <td>{{ $supplier->total_bill }}</td>
                        <td>{{ $supplier->paid_amount }}</td>
                        <td>{{ $supplier->due_amount }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
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