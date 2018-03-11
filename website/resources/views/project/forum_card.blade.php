@extends('project.project-layout')

@section('title', 'Forum')

@section('card-header')

<div class="row">
  <div class="col-md-8">
    <h5>Forum</h5>
  </div>
  <div class="col-md-4">
    <div class="float-right">
      <form>
        <div class="form-group">
          <select class="form-control slct-primary" id="sel_filter">
            <option class="slct-primary">Recently Updated</option>
            <option class="slct-primary">Most Replys</option>
            <option class="slct-primary">Last Updated</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('card-body')

<div class="card forum-card">
  <div class="card-header">
    <p>UI Design discussion</p>
  </div>
  <div class="card-body">
    <p>
      <b>Last message by @mpcm:</b>
    </p>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      Molestie nunc non blandit massa enim.
      At volutpat diam ut venenatis.
    </p>
    <p>
      show more...
    </p>
  </div>
  <div class="card-footer mt-0 pt-0">
    <p class="text-justify">
      2 days ago.
    </p>
  </div>
</div>
<div class="card forum-card">
  <div class="card-header">
    <p>General ideas</p>
  </div>
  <div class="card-body">
    <p>
      <b>Last message by @jotapsa:</b>
    </p>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      Molestie nunc non blandit massa enim.
      At volutpat diam ut venenatis.
    </p>
    <p>
      show more...
    </p>
  </div>
  <div class="card-footer mt-0 pt-0">
    <p class="text-justify">
      10 days ago.
    </p>
  </div>
</div>
<button type="button" id="forum-button" class="btn btn-block btn-xs m-0 p-0">...</button>

@endsection
