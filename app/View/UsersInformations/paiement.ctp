
<center>
<h3>

<?php echo $this->Form->input('voyage');
 



?>
</center>
</h3>
<div class="usersInformations index">
	<h2><?php echo __('Users Informations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			
			<th><?php echo $this->Paginator->sort('numero_da'); ?></th>
			<th><?php echo $this->Paginator->sort('prenom'); ?></th>
			<th><?php echo $this->Paginator->sort('nom'); ?></th>
			<th><?php echo $this->Paginator->sort('paiement'); ?></th>
			<td class="actions"><?php echo __('Actions'); ?></td>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usersInformations as $usersInformation): ?>
	<tr>
		
		<td><?php echo h($usersInformation['UsersInformation']['numero_da']); ?>&nbsp;</td>
		<td><?php echo h($usersInformation['UsersInformation']['prenom']); ?>&nbsp;</td>
		<td><?php echo h($usersInformation['UsersInformation']['nom']); ?>&nbsp;</td>
		<td><?php if($usersInformation['UsersInformation']['paiement'] == 1 ){
		echo "payé" ;
		}else{  
		echo "non payé"; } ?>&nbsp;</td>
		<td class="actions">
		<?php if($usersInformation['UsersInformation']['paiement'] == 0 ){
		  echo $this->Html->link(__('Effectuer paiement'), array('action' => 'effectuerPaiement', $usersInformation['UsersInformation']['id']));} ?>
		
		
			
			
		</td>
		
	
	</tr>
<?php endforeach; ?> 

		

