<?php require 'startpage.php' ?>
<?php
start_page('Billet');
?>
<body>
<?php $active = 'Billet';
require 'headerMenu.php';
?>
    <SCRIPT>
    function BoutonAffichageCategorie() { //affiche/cache la barre des categorie
        var x = document.getElementById('CategorieID');
        var con = document.getElementById('commentID');
        if (x.style.display == 'none') {
            x.style.display = 'block';
            con.style.marginLeft = '14.5vh'
        } else {
            x.style.display = 'none';
            con.style.marginLeft = '0.3vh'
        }
    }
    </SCRIPT>
    <button onclick="BoutonAffichageCategorie()" class="buttonCategorie">teste</button>
    <aside id="CategorieID" class="categories">
        <h2>Categories ici</h2>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </aside>

    <section id="commentID" class="comments">
        <h2>Billet ici</h2>
            <h3>Lorem ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porta nisi dolor, vel aliquam nunc bibendum id.
                Praesent tristique eget mauris nec rhoncus. Pellentesque vitae luctus leo, eu imperdiet elit. Maecenas mauris leo,
                gravida quis nibh non, gravida consectetur arcu.
                Vivamus at vulputate lacus. Pellentesque ut tempor dui, non scelerisque sapien. Aliquam et egestas neque.</p>
            <h3>Lorem ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porta nisi dolor, vel aliquam nunc bibendum id.
                Praesent tristique eget mauris nec rhoncus. Pellentesque vitae luctus leo, eu imperdiet elit. Maecenas mauris leo,
                gravida quis nibh non, gravida consectetur arcu. Vivamus at vulputate lacus.
                Pellentesque ut tempor dui, non scelerisque sapien. Aliquam et egestas neque.</p>
    </section>
<?php require 'endpage.php' ?>
<?php
end_page();
?>
</body>

</html>
