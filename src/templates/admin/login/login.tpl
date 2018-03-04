  <link rel="stylesheet" type="text/css" href="templates/admin/login/login.css"/>
  <script src="templates/admin/login/login.js"></script>

  <div id="signin-admin-modal" class="modal fade pt-20" tabindex="-1" role="dialog" data-show="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Administration Area</h4>
              </button>
          </div>
          <div class="modal-body mx-3">
              <div class="md-form mb-5">
                  <i class="fa fa-envelope prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="defaultForm-email">Username / Email</label>
                  <input type="email" class="form-control validate">
              </div>

              <div class="md-form mb-4">
                  <i class="fa fa-lock prefix grey-text"></i>
                  <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                  <input type="password" class="form-control validate">
              </div>

          </div>
          <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" href="#">Log in</a>
            </li>
          </ul>
      </div>
  </div>
</div>
