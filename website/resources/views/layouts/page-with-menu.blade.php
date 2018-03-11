
{{-- page with menu --}}
<div id=@yield('id') class="page-with-menu">
  @yield('content-top') <!-- optional -->
  <div class="row">
    <div class="col-md-3 menu">
      @yield('menu')
    </div>
    <div class="col-md-9">
      <div class="container-fluid panel">
        <div class="card">
          <div class="card-header panel-header">
            @yield('card-header')
          </div>
          <div id="card-body" class="card-body">
            @yield('card-body')
          </div>
          @yield('card-footer') <!-- optional so you have to create the div -->
        </div>
      </div>
    </div>
  </div>
</div>
