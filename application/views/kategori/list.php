<section class="pt-5">
    <div class="container">
        <h2 class="pb-5 center">Kategori List</h2>
        <div class="right mb-3">
            <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url().'kategori/add'; ?>';">+ Tambah Kategori</button>
        </div>
        <table id="example" class="display table" style="width:100%">
        <thead>
            <tr>
                <th class="center">Nama</th>
                <th class="center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($kategori as $row){ ?>
            <tr>
                <td><?php echo $row->nama ?></td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url() ?>kategori/edit/<?php echo $row->id ?>';">Edit</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
</section>