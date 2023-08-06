@extends('layouts.dashboard_app')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-auto py-5">
          <a class="btn btn-primary btn-sm m-3" href="{{ url('units') }}">Unit View</a>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Unit Create</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('units.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $unit->name }}" class="form-control" placeholder="Enter your name" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                      <option>{{ $unit->status }}</option>
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
                    >{{ $unit->description }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Create Unit</button>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection