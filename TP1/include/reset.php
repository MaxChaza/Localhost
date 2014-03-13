<?php 
    function resetCom(){ 
        // Ouverture du répertoire contenant les compteurs
        if($dossier = opendir('../counter'))
        {
            // Lecture chaque nom de fichier
            while(false !== ($fichier = readdir($dossier)))
            {
                // Exclusion des liens relatifs pour le déplacement dans les dossiers
                if($fichier != '.' && $fichier != '..')
                {
                    // Ajout de chaque nom de fichier à la liste
                    $listeCounter[]=$fichier;
                }
            }
            // Fermeture du répertoire
            closedir($dossier);
        }
        else
        {
            echo 'Le dossier n\' a pas pu être ouvert';
        }
        // Remise à zéro de chaque compteur 
        foreach($listeCounter as $fic)
        {
            $file = fopen ("../counter/".$fic , "w"); 
            $counter = 0;             
            fwrite($file , $counter ) ;            
            //we update //we write 
            fclose($file) ; 
        }
    } 
    // Appel de la fonction
    resetCom();
    // Redirection vers la page de contact
    header('location: ../index.php');
?>

