<section class="p-5">
    <div class="container">
        <h2 class="pb-5 center">Daftar Produk</h2>
        <div class="right mb-3">
            <?php if(isset($_SESSION['user_type'])) { 
                    if( (($_SESSION['user_type'])=='administrator') || (($_SESSION['user_type'])=='petugas') ) {?>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url().'produkc/add'; ?>';">+ Tambah Produk</button>
            <?php   }
            } ?>
        </div>
        
        <div class="row">
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

                    <?php 
                        if(isset($_SESSION['user_type'])) { 
                            if( (($_SESSION['user_type'])=='administrator') || (($_SESSION['user_type'])=='petugas') ) {
                    ?>
                        <button class="btn btn-primary mb-3" onclick="window.location.href='<?php echo base_url().'produkc/edit/'.$row->id; ?>';">Ubah</button>
                        <?php if($row->aktif==true) { ?>
                            <button type="button" class="btn btn-danger mb-3" onclick="if(confirm('Anda yakin ?')== true) window.location.href='<?php echo base_url() ?>produkc/deactivate/<?php echo $row->id ?>';">Nonaktifkan</button>
                        <?php }else{ ?>
                            <button type="button" class="btn btn-success mb-3" onclick="window.location.href='<?php echo base_url() ?>produkc/activate/<?php echo $row->id ?>';">Aktifkan</button>
                        <?php } ?>
                    <?php
                            }
                        } 
                    ?>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    </table>
</section>