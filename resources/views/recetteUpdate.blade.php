@extends('template')

@section('contenu')
    <nav>
        <div class="nav-wrapper">
            <a href="/recette" class="brand-logo">recettes</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="update">
            <h3>UPDATE</h3>
            <table>
                <tr>
                    <td>
                        <div class="input-field col s12">
                            <input id="label" type="text" name="label" value="{{$recette->label}}">
                            <label for="label">label</label></input>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-field col s12">
                            <input id="description" type="text" name="description" value="{{$recette->description}}">
                            <label for=" description">description</label></input>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="input-field col s12">
                            <select name="type">
                                <option value="" disabled>Choose your option</option>
                                @if($recette->type=="calorique")
                                    <option value="calorique" selected>calorique</option>
                                @else
                                    <option value="calorique" selected>calorique</option>
                                @endif
                                @if($recette->type=="maigre")
                                    <option value="maigre" selected>regime alimentaire maigre</option>
                                @else
                                    <option value="maigre">regime alimentaire maigre</option>
                                @endif
                                @if($recette->type=="vitamine")

                                    <option value="vitamine" selected>vitamines</option>
                                @else
                                    <option value="vitamine">vitamines</option>
                                @endif
                            </select>
                            <label>Choose your option</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>

                        </br></br>

                        <button class="btn waves-effect waves-light" type="submit" name="action">Update
                            <i class="material-icons right">!</i>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
        <a href="/mekelti/public/recette/link" class="waves-effect waves-light btn pink darken-1">consulter les recettes
            du jour</a>
    </div>
    </div>
@endsection  


