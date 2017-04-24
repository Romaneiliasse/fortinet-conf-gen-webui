@extends('layouts.app')

@section('content')
  @include('blocks/download')
  @include('blocks/upload')
  @if(!empty($conf))
    <div class="container col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Configuration générée <a class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a></h3>
        </div>
        <div class="panel-body">
          <pre>{{ $conf }}</pre>
        </div>
      </div>
    </div>
  @endif
@endsection
