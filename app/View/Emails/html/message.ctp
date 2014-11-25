<p>
<strong>Bonjour,</strong>
</p>

<p>
Un nouvel étudiant c'est inscrit au voyage. Voici ses informations :<br/>
<br/>
Nom : <strong><?php echo $prenom ?> <?php echo $nom ?></strong> <br/>
Numéro de DA : <strong><?php echo $noda ?></strong> <br/>
Pays : <strong><?php echo $pays ?></strong> <br/>
Programme : <strong><?php echo $programme ?></strong> <br/>
Voyage : <strong><?php echo $voyage ?></strong> <br/>
Date de naissance : <strong><?php echo $date_naiss ?></strong> <br/>
Passeport: <strong><?php echo $passeport ?></strong> <br/>
Date de délivrance : <strong><?php echo $delivrance ?></strong> <br/>
Date d'expiration : <strong><?php echo $expiration ?></strong> <br/>
Adresse : <strong><?php echo $adresse ?></strong> <br/>
Ville : <strong><?php echo $ville ?></strong> <br/>
Code postal : <strong><?php echo $code_postal ?></strong> <br/>
Téléphone : <strong><?php echo $telephone ?></strong> <br/>
Cellulaire : <strong><?php echo $cellulaire ?></strong> <br/>
Courriel : <strong><?php echo $courriel ?></strong> <br/>
Session : <strong><?php echo $session ?></strong> <br/>
Cours d'espagnol : <strong><?php echo $cours_espagnol ?></strong> <br/>
Cours d'espagnol précisé : <strong><?php echo $cours_espagnol_precise ?></strong> <br/>
<br/>
<br/>
Pour aller voir cet utilisateur a se joindre au voyage :
<?php echo $this->Html->link('Cliquer ici', $this->Html->url($link, true)); ?>
</p>