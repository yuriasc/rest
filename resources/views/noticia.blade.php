


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <meta name="csrf-token" value="{{ csrf_token() }}" />
  </head>
  <body>
    <div class="container col-md-6">
      <div>
        <h1 class="text-center">Nova Notícia</h1>
        <form action="http://localhost/api/noticia/store" method="POST">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Título:</label>
              <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Autor:</label>
                <input type="text" class="form-control" name="autor" value="{{ old('autor') }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Data:</label>
                <input type="text" class="form-control date" name="data" value="{{ old('data') }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Notícia:</label>
                <textarea class="form-control" name="noticia" rows="5">{{ old('noticia') }}</textarea>
              </div>
            </div>
          </div><br />
          <div class="form-group">
            <button class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js" type="text/javascript"></script>
    <script>
      $(document).ready(function() {
        $('.date').mask('00/00/0000');
      });
    </script>
  </body>
</html>

