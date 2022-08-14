<section>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 p-5">
          <h1 class="center">Ubah Kategori</h1>
          <form method="post" action="<?php echo base_url().'kategori/edit_process'; ?>">
            <div class="mb-3 mt-5">
              <label for="nama" class="form-label">Nama</label>
              <input value="<?php echo ucwords($kategori->nama) ?>" type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $kategori->id ?>" />
            <div class="right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</section>