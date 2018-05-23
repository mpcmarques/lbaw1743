@extends('layouts.app')

@section('title', 'New Project')

@section('content')

<div id="new-project" class="container-fluid">

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Project</li>
        </ol>
    </nav>

    {{-- main card --}}
    <div class="card">
        <div class="card-header panel-header">
            <h5>New Project</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ url('dashboard/new-project') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      @include('layouts.validation-input', ['name' => 'name'])
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="exampleTextarea">Description</label>
                    <div class="col-sm-9">
                      @include('layouts.validation-input-textarea', ['name' => 'description', 'rows' => '4'])
                    </div>
                </div>
                <fieldset class="form-group row">
                    <legend class="col-form-legend col-sm-3">Type</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input form-control" type="radio" name="private" id="public" value="false" checked>
                                Public
                            </label>
                        </div>
                        @if (Auth::user()->premium)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input form-control" type="radio" name="private" id="private" value="true">
                                Private
                            </label>
                        </div>
                        @endif
                    </div>
                </fieldset>

                <div class="form-group row">
                    <label class="col-sm-3">Image</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="projectPicture" name="projectPicture">
                            <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                        </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
