@extends('template')

@section('contenu')
    <nav>
        <div class="nav-wrapper">
            <a href="/mekelti/public/recette" class="brand-logo">recettes</a>
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
            @foreach($proposedRecettes as $recette)
                <tr>
                    <td width="150px">{{$recette->label}}</td>
                    <td>{{$recette->description}}</td>
                    <td width="100px">{{$recette->type}}</td>
                    <td><a href="proposition/{{$recette->id_Proposed}}/validate" class="waves-effect waves-light btn">valider</a>
                    <td><a href="proposition/{{$recette->id_Proposed}}/refuser"
                           class="waves-effect waves-light btn red">refuser</a>
                    </td>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection