
{{-- page with menu --}}
<div id=@yield('id') class="page-with-menu">
  @yield('foo')
  <div class="row">
    <div class="col-md-3 menu">
      @yield('menu')
    </div>
    <div class="col-md-9">
      <div class="container panel">
        <div class="card">
          <div class="card-header panel-header">
            @yield('card-header')
          </div>
          <div id="card-body" class="card-body">
            @yield('card-body')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
