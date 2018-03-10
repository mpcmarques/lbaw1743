@extends ('layouts.app')

@section('title', 'Task')

@section('content')

<div id="task" class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Project</a></li>
      <li class="breadcrumb-item active" aria-current="page">Task Name</li>
    </ol>
  </nav>
  <div class="card">
    <div class="card-header panel-header">
      <div class="row">
        <div class="col-6">
          <h5>Task name</h5>
        </div>
        <div class="col-6">
          <p class="text-right">Status:</p>
        </div>
      </div>
    </div>
    <div class="card-body">
      <p class="font-weight-light">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        Diam sollicitudin tempor id eu nisl nunc mi ipsum. - Task description
      </p>
      <pre>
        public class HelloWorld {
          public static void main(String[] args) {
            System.out.println("Hello World!");
          }
        }
      </pre>
    </div>
    <div class="card-footer">
      <small>
        created by @jotapsa on 30, February :<
      </small>
    </div>
  </div>
  <div class="card">
    <div class="card-header panel-header">
      <h5>Assigned</h5>
    </div>
    <div class="card-body">
      @include('layouts.user-card')
      @include('layouts.user-card')
      @include('layouts.user-card')
    </div>
  </div>
  <div class="card discussion-card">
    <div class="card-header panel-header">
      <h5>Discussion</h5>
    </div>
    <div class="card-body">
      <div class="media">
        <img class="mr-3" src="{{ asset('img/task-placeholder.svg') }}" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-0">Media heading</h5>
          Cras sit amet nibh libero, in gravida nulla.
          Nulla vel metus scelerisque ante sollicitudin.
          Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
          Fusce condimentum nunc ac nisi vulputate fringilla.
          Donec lacinia congue felis in faucibus.
          <div class="media mt-3">
            <a class="" href="#">
            <img src="{{ asset('img/task-placeholder.svg') }}" alt="Generic placeholder image">
            </a>
            <div class="media-body">
              <h5 class="mt-0">Media heading</h5>
              Cras sit amet nibh libero, in gravida nulla.
              Nulla vel metus scelerisque ante sollicitudin.
              Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
              Fusce condimentum nunc ac nisi vulputate fringilla.
              Donec lacinia congue felis in faucibus.
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-block btn-xs m-0 p-0">...</button>
    </div>
  </div>
</div>

@endsection
