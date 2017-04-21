@extends('layouts.app')

@section('content')
  <div class="container col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Télécharger le dernier fichier de collecte</h3>
      </div>
      <div class="panel-body" align="center">
        <h1>v{{ $version }}</h1>
        <a class="btn btn-success" href="/collect_file.xslx">Télécharger</a>
      </div>
    </div>
  </div>
  <div class="container col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Générer une configuration</h3>
      </div>
      <div class="panel-body">
        <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">Fichier Excel</label>
            <input type="file" name="file" id="file" />
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
@endsection
