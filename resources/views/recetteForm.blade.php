@extends('template')

@section('contenu')
<nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">Recette </a>
      <!--<ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="brand-logo" href="/">recettes</a></li>
    </ul>-->
  </nav>
  </div>
<div class="container">
<form method="POST" action="add">
	<h3></h3>
	<table>
		<tr><td>
			<div class="input-field col s12">
			<input id="label" type="text" name="label">
			<label for="label">label</label></input>
		</div>
		</td>
	</tr>
	<tr><td>
		<div class="input-field col s12">
		<input id="description" type="text" name="description">
		<label for="description">description</label></input>
	</div>
	</td>
</tr>

<tr><td>
	<div class="input-field col s12">
		<select name="type">
			<option value="" >Choose your option</option>
			<option value="calorique">calorique</option>
			<option value="maigre">regime alimentaire maigre</option>
			<option value="vitamine">vitamines</option>
		</select>
		<label>Choose your option</label>
	</div>
	</td>
</tr>
<tr><td>

</br>
</br>

  <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
        

</td>
</tr>
<tr><td>
		<h4>{{$response}}</h4>
	</td>
</tr>
</table>
</form>	

<a href="link" class="waves-effect waves-light btn pink darken-1">consulter les recettes du jour</a>
</div>
@endsection