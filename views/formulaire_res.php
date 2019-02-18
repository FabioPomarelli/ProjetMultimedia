<h1>valeur <em><?php echo $fic ?></em> insérée</h1>
<ul>
<?php
  foreach($values as $key => $val) {
    echo "<li><strong>$key</strong> = $val</li>\n";
  }
?>
</ul>
<p><a href="<?= $this->getUrl('insert') ?>">Insertion d'une nouvelle valeur</a></p>
<p><a href="<?= $this->getUrl('index') ?>">Retour à la case départ</a></p>