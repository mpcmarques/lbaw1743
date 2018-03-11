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
            <form>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Project name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="exampleTextarea">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="exampleTextarea" rows="4" placeholder="Project description"></textarea>
                    </div>
                </div>
                <fieldset class="form-group row">
                    <legend class="col-form-legend col-sm-3">Type</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                Public
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                Private
                            </label>
                        </div>
                    </div>
                </fieldset>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="exampleTextarea">Picture</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
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
        @endsection