<div class="container-fluid page-container">
  <div class="row">
    <div class="col-2">
      <div class="container">
        <div class="list-group">
          <button type="button" class="list-group-item list-group-item-action">
            Dashboard
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            My Projects
          </button>
          <button type="button" class="list-group-item list-group-item-action active">
            Tasks
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            Public Projects
          </button>
        </div>
      </div>
    </div>
    <div class="col-10">
      {include file='templates/tasks.tpl'}
    </div>
  </div>
</div>
