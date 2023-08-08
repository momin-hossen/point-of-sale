@extends('layouts.dashboard_app')

@section('dashboard_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-auto">
              <a class="btn btn-primary btn-sm m-3" href="{{ url('categories') }}">Category View</a>
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Category</h5>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                          <option>Status</option>
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
                        ></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Image:</label>
                        <input type="file" class="form-control" name="image"/>
                      </div>
                      <button type="submit" class="btn btn-primary">Create Category</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection   