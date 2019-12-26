@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        Edit listing
        <span class="float-right">
          <a href="/home"
              class="btn btn-secondary">Go Back</a>
        </span>
      </div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="/listings/{{ $listing->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"
                      id="name" placeholder="Listing Name" value="{{ $listing->name }}">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address"
                      id="address" placeholder="Listing Address" value="{{ $listing->address }}">
            </div>
            <div class="form-group">
              <label for="website">Website</label>
              <input type="text" class="form-control" name="website"
                      id="website" placeholder="Listing Website" value="{{ $listing->website }}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email"
                      id="email" placeholder="Your Email" value="{{ $listing->email }}">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="number" class="form-control" name="phone"
                      id="phone" placeholder="Your Phone" value="{{ $listing->phone }}">
            </div>
            <div class="form-group">
              <label for="bio">Bio</label>
              <input type="text" class="form-control" name="bio"
                      id="bio" placeholder="Listing Bio" value="{{ $listing->bio }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
