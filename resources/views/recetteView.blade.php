@extends('template')

@section('contenu')
<nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">recettes</a>
      
  </nav>
<div class="container">

  
        
	<table border=2	class="bordered striped">
		<thead>
		<tr>
              <th >label</th>
              <th >description</th>
              <th>type</th>
          </tr>
      </thead>
      <tbody>
		@foreach($recettes as $recette)
		<tr> <td width="150px">{{$recette->label}}</td><td>{{$recette->description}}</td><td width="100px">{{$recette->type}}</td><td><a href="/update/{{$recette->id_recette}}"  class="waves-effect waves-light btn">modifier recette</a>
    </td>
    
		@endforeach
		</tbody>
</table>
<a href="form"  class="waves-effect waves-light btn">ajouter recette</a>
</div>
@endsection