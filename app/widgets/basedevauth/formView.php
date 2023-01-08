<div class="login-box w_basedevauth">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?=$this->base_url?>" class="h1"><b><?=$labels['development']?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?=$labels['signinlabel']?></p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" name="<?=$this->prefix_kebab?>login" value="<?=$login?>" class="form-control" placeholder="<?=$labels['login']?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="<?=$this->prefix_kebab?>password" value="<?=$password?>" class="form-control" placeholder="<?=$labels['password']?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="<?=$this->prefix_kebab?>remember" <?=$remember?>>
              <label for="remember">
              <?=$labels['remember']?>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"><?=$labels['signin']?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->