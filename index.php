<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dextructables | Gráficas con pChart</title>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet'>
        <link href='css/styles.css' rel='stylesheet'>
    </head>
    <body>
        <div id="container">
            <form id="forma">
                <label for="type">Tipo de gráfica</label>
                <input type="radio" id="type" name="type" value="1" checked>Barras
                <input type="radio" id="type" name="type" value="2">Líneas <br/>
                <label for="source">Fuente de datos</label>
                <input type="radio" id="source" name="source" value="1" checked>Array
                <input type="radio" id="source" name="source" value="2">Base de datos
                <input type="radio" id="source" name="source" value="3">Archivo de texto
            </form>
            <a href="#" class="loader">Cargar Gráfica</a><br/>
            <div id="image">
            </div>
        </div>
     <script src="librerias/jquery.js"></script>
     <script>
         $(function(){

             var grafica = $('<img/>',{id:'target'});
             var imagen  = $('#image');

             $('.loader').on('click', function(e){
                 e.preventDefault();

                 imagen.children().remove()
                 .end().addClass('loading');

                 grafica.hide();
                 loadImage();
                 
             });

             function loadImage(){
                 $.ajax({
                 type:'GET',
                 dataType:'json',
                 cache:false,
                 url:'graficar.php',
                 data: $('#forma').serialize(),
                 success: function(data, status){
                     if (data.error == 0) { 

                         grafica.attr('src', data.path);
                         imagen.removeClass('loading').
                         append(grafica);
                         grafica.fadeIn(400);
                         
                     }
                 }

                 });
             }


         });
     </script>
    </body>
</html>