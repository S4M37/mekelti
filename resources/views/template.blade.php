<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECETTE</title>

    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css') !!}
    {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/nanoscroller.css') !!}
    {!! Html::style('css/materialize.css') !!}

    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') !!}
    {!! Html::script('http://malsup.github.com/min/jquery.form.min.js') !!}
    {!! Html::script('js/materialize.js') !!}
    {!! Html::script('js/jquery.nanoscroller.min.js') !!}<!---->

</head>
<body>

@yield('contenu')

<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>
</body>
</html>
