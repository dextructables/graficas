<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dextructables | Gráficas con pChart</title>
    </head>
    <body>
        <form id="forma">
            <label for="type">Tipo de gráfica</label>
            <input type="radio" id="type" name="type" value="1" checked>Barras
            <input type="radio" id="type" name="type" value="2">Líneas <br/>
            <label for="source">Fuente de datos</label>
            <input type="radio" id="source" name="source" value="1" checked>Array
            <input type="radio" id="source" name="source" value="2">Base de datos
            <input type="radio" id="source" name="source" value="3">Archivo de texto
        </form>
        <a href="#" class="loader">Cargar</a><br/>
        <img id="target" src="img/random.jpg" />  
     <script src="librerias/jquery.js"></script>
     <script>
         $(function(){source
             $('.loader').on('click', function(e){
                 e.preventDefault();
                 $.ajax({
                 type: 'GET',
                 dataType: 'json',
                 cache: false,
                 url: 'graficar.php',
                 data: $('#forma').serialize()
                 }).done(function( data ) {
                     $('#target').attr('src', data.path);
                 });
                 });
         });
     </script>
    </body>
</html>