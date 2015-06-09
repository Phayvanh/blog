function onThemeChanged()
{
    window.location.reload(true);//permet de raffraichir la page automatiquement
}

function onChangeTheme()
{
    $.post('ajax/update-blog-theme.php',//on pointe l'url qu'on veut obtenir
        {blogId:1,//on donne la valeur du blog
         themeId:$(this).val()},//on récupère la valeur de l'option du select
        onThemeChanged);//on créer une nouvelle fonction
}


/******************************************Code principal********************************************************/
$(function()
{//a chaque fois qu'une option sera selectionné le thème changera
    $('#js-theme').on('change', onChangeTheme);
});