@extends('template')

@section('contenu')

<nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">choisir le lien de recette</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="/">recettes</a></li>
    </ul>
  </nav>
  </div>
<div class="container">
  <table class="centered highlight">
    <tr><td>
  <a href="feed/1">recettes-cuisine-afrique</a>
<tr><td>
  <a href="feed/2">gourmandines</a>
 <tr><td>
  <a href="feed/3">recette-dessert</a>
</table>
</div>
@endsection