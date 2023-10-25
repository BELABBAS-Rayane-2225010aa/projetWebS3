<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<?php $active = 'categorie';
require 'HeaderMenu.php' //Charge le bar menu ?>
    <h1 id="milieu">Recherche</h1>
    <table>
        <tr>
            <th>User</th>
            <td>Utilisateur 1</td>
            <td>Utilisateur 2</td>
        </tr>
        <tr>
            <th>Categories</th>
            <td>Catégorie 1</td>
            <td>Catégorie 2</td>
        </tr>
        <tr>
            <th>Commentaire</th>
            <td>Commentaire 1</td>
            <td>Commentaire 2</td>
        </tr>
        <tr>
            <th>Billet</th>
            <td>Billet 1</td>
            <td>Billet 2</td>
        </tr>
        <!-- Ajoutez autant de lignes que nécessaire -->
    </table>
<?php
end_page();
?><?php
