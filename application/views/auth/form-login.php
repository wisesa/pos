<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5 right">
        <img src="<?php echo base_url().'asset/img/sit.jpg'; ?>" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 left">
        <h1 class="center mb-5">AKSES MASUK</h1>
        <form action="<?php echo base_url().'auth/process_login'; ?>" method="post">
          <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Masukan alamat email" required />
          </div>

          <div class="form-outline mb-3">
            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Masukan kata sandi" required />
          </div>

          <div class="right text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>