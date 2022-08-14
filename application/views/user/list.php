<section class="pt-5">
    <div class="container">
        <h2 class="pb-5 center"><?php echo ucwords($type) ?> List</h2>
        <div class="right mb-3">
            <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url().'user/add/'.$type; ?>';">+ Tambah <?php echo ucwords($type) ?></button>
        </div>
        <table id="example" class="display table" style="width:100%">
        <thead>
            <tr>
                <th class="center">Nama</th>
                <th class="center">Email</th>
                <th class="center">Kontak</th>
                <th class="center">Status</th>
                <th class="center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($user as $row){ ?>
            <tr>
                <td><?php echo $row->nama ?></td>
                <td><?php echo $row->email ?></td>
                <td><?php echo $row->kontak ?></td>
                <td><?php if($row->aktif==1) echo "Aktif"; else echo "Non Aktif"; ?></td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url() ?>user/edit/<?php echo $row->id ?>';">Ubah</button>
                    <?php if($row->aktif==true) { ?>
                        <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ?')== true) window.location.href='<?php echo base_url() ?>user/deactivate/<?php echo $row->id ?>';">Deactivate</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-success" onclick="window.location.href='<?php echo base_url() ?>user/activate/<?php echo $row->id ?>';">Activate</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
</section>