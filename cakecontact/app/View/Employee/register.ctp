<?php 
$this->Html->script('jquery', array('block' => 'script'));
?>
<h2>Create Data Pegawai</h2>
<p>Gunakan form berikut ini untuk create contact baru.</p>
<?php if ($createStep == 1) : ?>
<h4>Data Pribadi</h4>
<?=$this->Form->create(false)?>
<?=$this->Form->input('nip', array('label' => 'NIP'))?>
<?=$this->Form->input('first_name', array('label' => 'Nama Depan'))?>
<?=$this->Form->input('middle_name', array('label' => 'Nama Tengah'))?>
<?=$this->Form->input('last_name', array('label' => 'Nama Belakang'))?>
<?=$this->Form->input('birth_place', array('label' => 'Tempat Lahir'))?>
<?=$this->Form->input('birth_date', array('label' => 'Tanggal Lahir'))?>
<?=$this->Form->input('sex', array('label' => 'Jenis Kelamin'))?>
<?=$this->Form->end(array('label' => 'Lanjut', 'div' => array('class' => 'formSaveButtonCont')))?>

<?php elseif ($createStep == 2) : ?>
<h4>Data Alamat Email</h4>
<?=$this->Form->create(false)?>
<?=$this->Form->input('address', array('label' => 'Alamat Email'))?>
<?=$this->Form->end(array('label' => 'Lanjut', 'div' => array('class' => 'formSaveButtonCont')))?>

<?php elseif ($createStep == 3) : ?>
<h4>Data Alamat</h4>
<?=$this->Form->create(false)?>
<?=$this->Form->input('street', array('label' => 'Alamat'))?>
<?=$this->Form->input('city', array('label' => 'Kota'))?>
<?=$this->Form->input('province', array('label' => 'Propinsi'))?>
<?=$this->Form->input('postal_code', array('label' => 'Kode Pos'))?>
<?=$this->Form->end('Lanjut')?>

<?php elseif ($createStep == 4) : ?>
<h4>Data Telepon</h4>
<?=$this->Form->create(false)?>
<?=$this->Form->input('phone_number', array('label' => 'Nomor Telepon'))?>
<?=$this->Form->input('phone_type', array('label' => 'Jenis Telepon', 'options' => array('1' => 'Telepon Rumah', '2' => 'Telepon Selular', '3' => 'Telepon Kantor', '0' => 'Lainnya')))?>
<?=$this->Form->end('Lanjut')?>

<?php elseif ($createStep == 5) : ?>
<h4>Upload Foto</h4>
<?=$this->Form->create(false, array('type' => 'file'))?>
<?=$this->Form->input('uploaded_photo', array('label' => 'Foto Profile', 'type' => 'file'))?>
<?=$this->Form->end('Lanjut')?>


<?php elseif ($createStep == 6) : ?>
<h4>Konfirmasi</h4>
<?=$this->Form->create(false)?>
<?=$this->Form->end('Simpan')?>
<?php endif; ?>