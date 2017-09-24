@extends('layouts.app')

@section('content')
<deletebookmark inline-template>
    <div class="col-md-8">
    @if($bookmarks->count())
      @foreach($bookmarks as $bookmark)

          <div class="media my-5" id="bookmark-{{ $bookmark->id }}">
            @if( $bookmark->cover )
              <img class="test-img d-flex img-fluid align-self-center mr-3" src="{{ asset('images/' . $bookmark->cover) }}" alt="Generic placeholder image">
            @endif
            <div class="media-body">
              <h5 class="mt-0"><a href="{{ $bookmark->url }}">{{ $bookmark->title }}</a></h5>
              {{ $bookmark->description }}
              <div class="info d-flex justify-content-start">
                <small class="text-muted ">Created at: {{ $bookmark->created_at->diffForHumans() }}</small>
                <span class="ml-auto"><a href="{{route('bookmark.category.index', $bookmark->category->name)}}" class="badge badge-primary">{{ $bookmark->category->name }}</a>
                  <a href="#" class="badge badge-danger" @click="test({{ $bookmark->id }})">Delete</a>
                </span>
              </div>
            </div>
          </div>

          <!-- <div class="card mb-3" id="bookmark-{{ $bookmark->id }}">
            @if( $bookmark->cover )
              <img class="card-img-top img-fluid" src="{{ asset('images/' . $bookmark->cover) }}" alt="Card image cap">
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
          </div> -->
      @endforeach
    @endif

    </div>
</deletebookmark>

  <div class="col ml-auto">
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
