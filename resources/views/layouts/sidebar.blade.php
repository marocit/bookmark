

<aside id="sidebar" class="mb-3">
  <div class=" d-block h-50">
    <clock></clock>
    <h4 class="text-muted mb-3 mt-2 text-uppercase">Suche</h4>
    <div class="c-line-left"></div>
      <form action="{{ route('bookmark') }}">
        <div class="input-group">
          <input type="text" class="form-control" name="term" value="{{ request('term') }}" placeholder="Search for..." aria-label="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Go!</button>
          </span>
        </div>
      </form>
    <h4 class="mb-3 mt-5 text-muted text-uppercase">Users Online</h4>
    <div class="c-line-left"></div>
    <counter></counter>

    <h4 class="mb-3 mt-5 text-muted text-uppercase">Bookmark</h4>
    <div class="c-line-left"></div>
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addBookmarkModal">
      <i class="fa fa-plus"></i> Add Bookmark
    </button>

    <h4 class="text-muted mb-3 mt-5 text-uppercase">Kategorien</h4>
    <div class="c-line-left"></div>
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addCategoryModal">
      <i class="fa fa-plus"></i> Add Category
    </button>
    @if($sidebarCategories->count())
      <div class="list-group">
        @foreach($sidebarCategories as $category)
          <a class="list-group-item list-group-item-action" href="{{route('bookmark.category.index', $category->name)}}">{{ $category->name }} <span class="badge badge-secondary ml-3">{{ $category->bookmarks()->count() }}</span> </a>
        @endforeach
      </div>
    @endif
    <h4 class="text-muted mb-3 mt-5 text-uppercase">Twitter <i class="fa fa-twitter"></i> </h4>
    <div class="c-line-left"></div>
    <!-- <div class="list-group">
      @foreach($tweets as $key => $tweet)
        <a class="list-group-item list-group-item-action" href="#">{{ $tweet['text'] }}  </a>
      @endforeach
    </div> -->
      @foreach($tweets as $key => $tweet)
        <p class="" >{{ $tweet['text'] }}  </p>
      @endforeach
  </div>
</aside>

<div id="addBookmarkModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Bookmark</h5>

        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      {!! Form::open(['route' => 'bookmark.store']) !!}
      <div class="modal-body">
          <div class="form-group">
            {!! Form::label('url', 'URL:') !!}
            {!! Form::text('url', null, ['class'=>'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('category_id', 'Kategorie:') !!}
            {!! Form::select('category_id', [''=>'Choose Categories'] + $categories ? $categories : 'Nichts' , null, ['class'=>'form-control']) !!}
          </div>
      </div>
      <div class="modal-footer">
        {!! Form::submit('Add Bookmark', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="addCategoryModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {!! Form::open(['route' => 'bookmark.category.store']) !!}
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Category</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">

          <div class="form-group">
            {!! Form::label('name', 'Kategorie:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
          </div>

      </div>
      <div class="modal-footer">
        {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::close() !!}
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

    </div>

  </div>
</div>

<!-- <section id="header-section" class="my-5">
  <div class="card">
    <div class="card-body">
      {!! Form::open(['route' => 'bookmark.store']) !!}
        <div class="form-group">
          {!! Form::label('url', 'URL:') !!}
          {!! Form::text('url', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category_id', 'Kategorie:') !!}
          {!! Form::select('category_id', [''=>'Choose Categories'] + $categories , null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group text-center">
          {!! Form::submit('Add Bookmark', ['class' => 'btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</section> -->
