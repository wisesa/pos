<section>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 p-5">
          <h1 class="center">Tambah Kategori</h1>
          <form method="post" action="<?php echo base_url().'kategori/add_process'; ?>">
            <div class="mb-3 mt-5">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" required>
            </div>
            <div class="right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</section>