@extends('layouts.app')

@section('content')



  <div class="col-md-8">
    <section id="bookmark-section" class="my-5">
        @foreach($bookmarks as $bookmark)
                <div class="card mb-3">
                  @if( $bookmark->cover )
                    <img class="card-img-top" src="{{ asset('images/' . $bookmark->cover) }}" alt="Card image cap">
                  @endif
                  <div class="card-body">
                    <h4 class="card-title">{{ $bookmark->title }}</h4>
                    <p class="card-text">
                      {{ $bookmark->description }}
                    </p>
                    <p class="card-text"><small class="text-muted">Created at: {{ $bookmark->created_at->diffForHumans() }}</small></p>
                    <!-- <a href="#" class="badge badge-primary">{{ $bookmark->category->name }}</a> -->
                  </div>
                </div>
        @endforeach
    </section>
  </div>

  <div class="col-md-4">
    @include('layouts.sidebar')
  </div>
    <section id="pagination">
      <div class="container">
        <div class="row justify-content-center">
          {{ $bookmarks->links() }}
        </div>
      </div>
    </section>

@endsection
