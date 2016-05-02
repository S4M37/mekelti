@extends('template')

@section('contenu')
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="proposition">propositions</a></li>
    </ul>
    <nav>
        <div class="nav-wrapper">
            <a href="/mekelti/public/recette" class="brand-logo">recettes</a>
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1">PLUS<i
                                class="material-icons right">more_vert</i></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">


        <table border=2 class="bordered striped">
            <thead>
            <tr>
                <th>label</th>
                <th>description</th>
                <th>type</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recettes as $recette)
                <tr>
                    <td width="150px">{{$recette->label}}</td>
                    <td>{{$recette->description}}</td>
                    <td width="100px">{{$recette->type}}</td>
                    <td><a href="recette/{{$recette->id_Recette}}/form" class="waves-effect waves-light btn">modifier
                            recette</a>
                    <td><a href="recette/{{$recette->id_Recette}}/delete" class="waves-effect waves-light btn red">supprimer
                            recette</a>
                    </td>

            @endforeach
            @foreach($proposedRecettes as $recette)
                <tr>
                    <td width="150px">{{$recette->label}}</td>
                    <td>{{$recette->description}}</td>
                    <td width="100px">{{$recette->type}}</td>
                    <td><a href="recette/{{$recette->id_Recette}}/form" class="waves-effect waves-light btn">modifier
                            recette</a>
                    <td><a href="recette/{{$recette->id_Recette}}/delete" class="waves-effect waves-light btn red">supprimer
                            recette</a>
                    </td>

            @endforeach
            </tbody>
        </table>
        <a href="recette/form" class="waves-effect waves-light btn">ajouter recette</a>
    </div>
@endsection