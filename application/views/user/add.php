<section>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 p-5">
          <h1 class="center">Tambah <?php echo ucwords($type) ?></h1>
          <form method="post" action="<?php echo base_url().'user/add_process'; ?>">
            <div class="mb-3 mt-5">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
            </div>
            <?php if($type<>'supplier'){ ?>
            <div class="mb-2">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <?php } ?>
            <div class="mb-3">
              <label for="kontak" class="form-label">Kontak</label>
              <input type="text" class="form-control" id="kontak" name="kontak" aria-describedby="kontak" required>
            </div>
            <input type="hidden" name="type" value="<?php echo $type ?>" />
            <div class="right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</section>