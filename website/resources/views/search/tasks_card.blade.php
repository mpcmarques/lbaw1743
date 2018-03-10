@extends('search.search-layout')

@section('title', 'Tasks')

@section('card-header')
<div class="row">
  <div class="col-6">
    <h5 class="panel-title">Tasks</h5>
  </div>
  <div class="col-6">
    <form>
      <div class="form-group text-right">
        <select class="form-control" id="sel_filter">
          <option>Best match</option>
        </select>
      </div>
    </form>
  </div>
</div>
@endsection

@section('card-body')
<div class="card">
  <div class="card-header">
    <p>#132 - Change profile name</p>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <p class="text-left">
          <b>Project Name</b>
        </p>
      </div>
      <div class="col-6">
        <p class="text-right">
          @jotapsa
        </p>
      </div>
    </div>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      Molestie nunc non blandit massa enim.
      At volutpat diam ut venenatis.
    </p>
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-6">
        <p class="text-left">
          last updated 2 days ago.
        </p>
      </div>
      <div class="col-6 text-right">
        <span class="octicon octicon-comment-discussion"/>
        <span class="octicon octicon-organization"/>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <p>#132 - Change profile name</p>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6">
        <p class="text-left">
          <b>Project Name</b>
        </p>
      </div>
      <div class="col-6">
        <p class="text-right">
          @jotapsa
        </p>
      </div>
    </div>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      Molestie nunc non blandit massa enim.
      At volutpat diam ut venenatis.
    </p>
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-6">
        <p class="text-left">
          last updated 2 days ago.
        </p>
      </div>
      <div class="col-6 text-right">
        <span class="octicon octicon-comment-discussion"/>
        <span class="octicon octicon-organization"/>
      </div>
    </div>
  </div>
</div>
@endsection

