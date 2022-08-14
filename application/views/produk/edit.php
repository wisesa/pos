<section>
  <div class="container">
    <div class="row">
        <div class="col-lg-12 p-5">
          <h1 class="center">Ubah Produk</h1>
          <form id="form_add_produk" method="post" action="<?php echo base_url().'produkc/edit_process'; ?>">
            <div class="mb-3 mt-5">
              <label for="nama" class="form-label">Kategori</label>
              <div>
              <select class="js-example-basic-single" name="id_kategori" style="width:100%">
                <?php foreach($kategori as $row) { ?>
                <option <?php if($row->id==$produk->id_kategori) echo "selected" ?> value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                <?php } ?>
              </select>
              </div>
            </div>
            <div class="mb-3 mt-3">
              <label for="nama" class="form-label">Nama</label>
              <input value="<?php echo $produk->nama_produk ?>" type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" required>
            </div>
            <div class="mb-3 mt-3">
              <label for="nama" class="form-label">Harga Beli</label>
              <input value="<?php echo $produk->harga_beli ?>" type="number" class="form-control" id="harga_beli" name="harga_beli" aria-describedby="nama" required>
            </div>
            <div class="mb-3 mt-3">
              <label for="nama" class="form-label">Harga Jual</label>
              <input value="<?php echo $produk->harga_jual ?>" type="number" class="form-control" id="harga_jual" name="harga_jual" aria-describedby="nama" required>
            </div>
            <div class="mb-3 mt-3">
              <label for="nama" class="form-label">Deskripsi</label>
              <textarea id="summernote" name="deskripsi"><?php echo $produk->deskripsi ?></textarea>
            </div>
            <input type="hidden" name="gambar_old" id="gambar_old" value="<?php echo $produk->gambar ?>" />
            <input type="hidden" name="gambar" id="gambar" />
            <input type="hidden" name="id" id="id" value="<?php echo $produk->id ?>" />
          </form>
          
          <form id="form_upload_image_produk" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="mb-2">Choose a file:</label>
              <input type="file" class="form-control" id="upl-file" name="upl_file">  
              <span class="mt-2" id="chk-error"></span>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="progress" style="display: none;">
                  <div id="file-progress-bar" class="progress-bar"></div>
                  <div id="uploaded_file" class="center"></div>
              </div>
              <div class="center">
                <img src="<?php echo base_url().'produk/'.$produk->gambar ?>" id="img-product" class="img-product mt-3" />
              </div>
            </div>
            <div class="right mt-5">
                <button id="submit_upload_image" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</section>

<script type="text/javascript">
    jQuery(document).on('submit', '#form_upload_image_produk', function(e){
        if($("#gambar").val()==''){
          e.preventDefault();
          $('#form_add_produk').submit();
        }else{
          jQuery("#chk-error").html('');
          jQuery('.progress').show();
          e.preventDefault();
          $.ajax({
              xhr: function() {
                  var xhr = new window.XMLHttpRequest();         
                  xhr.upload.addEventListener("progress", function(element) {
                      if (element.lengthComputable) {
                          var percentComplete = ((element.loaded / element.total) * 100);
                          $("#file-progress-bar").width(percentComplete + '%');
                          $("#file-progress-bar").html(percentComplete+'%');
                      }
                  }, false);
                  return xhr;
              },
              type: 'POST',
              url:"<?php echo base_url(); ?>produkc/upload_image",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,
              dataType:'json',
              beforeSend: function(){
                  $("#file-progress-bar").width('0%');
              },

              success: function(json){
                  if(json == 'success'){
                      $('#uploaded_file').html('<p style="color:#28A74B;">Gambar berhasil diunggah</p>');
                      $('#form_add_produk').submit();
                  }else if(json == 'failed'){
                      $('#uploaded_file').html('<p style="color:#EA4335;">Mohon pilih tipe file yang sesuai</p>');
                  }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
              }
          });
        }
    });
  
    $("#upl-file").change(function(){
        var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)) {
            $("#gambar").val('');
            jQuery("#chk-error").html('<small class="text-danger">Mohon pilih tipe file yang sesuai (JPEG/JPG/PNG/GIF)</small>');
            $("#upl-file").val('');
            return false;
        } else {
            var filename = file['name'];
            var new_filename = filename.replace(" ", "_");
            $("#gambar").val(new_filename);
            var image = document.getElementById('img-product');
            image.src = URL.createObjectURL(file);
            jQuery("#chk-error").html('');
        }
    });
</script>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>