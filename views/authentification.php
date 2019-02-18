<form action="#" method="POST"> 
 <fieldset>
   <legend>Authentification</legend>
    
        <?php

        if (isset($message))
        {
            echo ">>>>".$message."<br/>";
        }

        ?>

   <input type="hidden" name="action" value="authentification_res"/>
   <input type="text" name="nom" placeholder="ex : User1234"/>
   <input type="text" name="password" placeholder="ex : Mot2pass!"/>
   <input type="submit" name="envoyer"/>
 </fieldset>
</form>
<p><a href="<? echo $this->getUrl('index') ?>">Retour à la case départ</a></p>