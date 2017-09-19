@extends('layouts.app')
@section('addbookmark')
<section id="header-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6 ">
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
          </div>
        </div>
      </div>
    </section>
@endsection
