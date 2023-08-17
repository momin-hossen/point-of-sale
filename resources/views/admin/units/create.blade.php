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
              <h3>Unit Create</h3>
            </div>
            <div class="col text-end align-item-center">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('units') }}"><i class='menu-icon tf-icons bx bx-list-ul' ></i>Unit View</a>
            </div>
          </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Unit Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('units.store') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter your name" />
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label">Status</label>
                      <select class="form-select" name="status">
                        <option>Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div>
                    <div class="mb-3 col-12">
                      <label class="form-label">Description</label>
                      <textarea
                        class="form-control"
                        placeholder="Enter your description"
                        name="description"
                      ></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-save' ></i>Create Unit</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection
