@extends('layouts.app')

@section('title', 'New Post')

@section('content')

<div id="new-post" class="container-fluid">

  {{-- breadcrumb --}}
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{
        url('project/'.$project->idproject.'/')
      }}">{{ $project->name }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Reply</li>
    </ol>
  </nav>

  {{-- main card --}}
  <div class="card">
    <div class="card-header panel-header">
      <h5>New Reply</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('project/'.$project->idproject.'/'.$post->idPost.'/new-reply') }}">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Content</label>
          <div class="col-sm-9">
            @include('layouts.validation-input-textarea', ['name' => 'content', 'rows' => '4'])
          </div>
        </div>

        <div class="form-group row" style="margin-bottom: 0;">
          <div class="container-fluid">
            <button type="submit" class="btn btn-primary">
              <span class="octicon octicon-plus"></span>
              Create
            </button>
            <div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
