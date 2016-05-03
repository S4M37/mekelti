@extends('template')

@section('contenu')

  <nav>
    <div class="nav-wrapper">
      <a href="{{ $permalink }}" class="brand-logo">{{ $title }}</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="/mekelti/public/recette">recettes</a></li>
    </ul>
  </nav>
  @foreach ($items as $item)
    <div class="item">
      <h4><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h4>
      {{ $item->get_description() }}
      <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>
      <a href="addparsedrecipe?label={{$item->get_title()}}&amp;description={{$item->get_description()}}">ajouter cette recette</a>
    </div>
  @endforeach
@endsection