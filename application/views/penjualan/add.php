<section class="p-5">
    <div class="container">
        <h2 class="pb-2 center">Penjualan</h2>
        <div>
            <div class="row">
                <div class="right mb-3">
                    <h2 class="pb-3 center">Silahkan Pilih Barang</h2>
                </div>

            <?php foreach($produk as $row){ ?>
                <div class="col-lg-3 col-md-6 center p-1">
                    <div style="border:1px solid black;">
                        <img class="img-product" src="<?php echo base_url().'produk/'.$row->gambar; ?>" />
                        <h4 class="mb-3"><?php echo $row->nama_produk; ?></h4>
                        <h4 class="mb-5">Rp. <?php echo number_format($row->harga_jual,0,",","."); ?></h4>
                    <h5 class="mb-4"><?php if($row->stok==0) echo 'Stok tidak tersedia'; echo $row->stok.' stok tersedia'; ?></h5>
                        <div class="px-4">
                            <?php echo $row->deskripsi ?>
                        </div>
                        
                        <button class="btn btn-primary mb-3" onclick="chooseProduct('<?php echo $row->id ?>', '<?php echo $row->harga_jual ?>');">Beli</button>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <form id="form_penjualan" method="post" action="<?php echo base_url().'penjualan/add_process'; ?>">
            <input type="hidden" id="id_produk" name="id_produk" />
            <input type="hidden" id="harga" name="harga" />
        </form>
    </div>
    </table>
</section>

<script>
    function chooseProduct(product, harga){
        $("#id_produk").val(product);
        $("#harga").val(harga);
        $("#form_penjualan").submit();
    }
</script>