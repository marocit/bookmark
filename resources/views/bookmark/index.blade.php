@extends('layouts.app')

@section('content')

<deletebookmark inline-template>
    <div class="col-md-8">
    @if($bookmarks->count())
      @foreach($bookmarks as $bookmark)
          <div class="card mb-3" id="bookmark-{{ $bookmark->id }}">
            @if( $bookmark->cover )
              <img class="card-img-top" src="{{ asset('images/' . $bookmark->cover) }}" alt="Card image cap">
            @endif
            <div class="card-body">
                <h4 class="card-title"><a href="{{ $bookmark->url }}">{{ $bookmark->title }}</a></h4>
              <p class="card-text">
                {{ $bookmark->description }}
              </p>
              <p class="card-text"><small class="text-muted">Created at: {{ $bookmark->created_at->diffForHumans() }}</small></p>
              <hr>
              <a href="#" class="badge badge-primary">{{ $bookmark->category->name }}</a>
              <button class="btn btn-danger btn-sm" @click="test({{ $bookmark->id }})">Delete</button>
            </div>
          </div>
      @endforeach
    @endif
    </div>
</deletebookmark>

  <div class="col-md-3 ml-auto">
    @include('layouts.sidebar')
  </div>


@endsection

@section('pagination')
    <section id="pagination">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6 col-md-4"></div>

            <div class="col-6">
              {{ $bookmarks->links() }}
            </div>
            <div class="col-6 col-md-4"></div>
          </div>
        </div>
    </section>
  @endsection
