function BoutonAffichageCategorie() { //affiche/cache la barre des categorie
    var x = document.getElementById('CategorieID');
    var con = document.getElementById('commentID');
    if (x.style.display != 'none') {
        x.style.display = 'none';
        con.style.marginLeft = '0.3vh'
    } else {
        x.style.display = 'block';
        con.style.marginLeft = '14.5vh'
    }
}