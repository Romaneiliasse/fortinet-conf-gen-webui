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
