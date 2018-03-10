
{{-- page with menu --}}
<div id=@yield('id') >
  <div class="row">
    <div class="col-md-2">
      @yield('menu')
    </div>
    <div class="col-md-10">
      <div class="container">
        <div class="card">
          <div class="card-header panel-header">
            @yield('card-header')
          </div>
          <div class="card-body">
            @yield('card-body')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

