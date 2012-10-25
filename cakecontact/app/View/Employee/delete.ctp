<?php 
$this->Html->script('jquery', array('block' => 'script'));
?>
<h2>Delete Data Pegawai</h2>
<p>Anda setuju untuk menghapus data pegawai dengan NIP : <?=$deletedNip?></p>
<?=$this->Form->create(false)?>
<?=$this->Form->end('Hapus Data')?>
