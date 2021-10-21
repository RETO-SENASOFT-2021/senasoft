
<?php

    $charset = "1234567890ABCDEF";
    $clave = "";
    for($i=0; $i<5;$i++){
        $clave .=substr($charset, rand(0, 16),1);
} 


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bugs Find 2021</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="estilos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            
            <h1 class="titulo">BUGS FIND 2021</h1>
            <nav class="botones">
                <a href="index.html"><button class="btn btn-primary">Salir</button></a>
            </nav>
        </div>
        <div class="centro">
            <img src="images/mascara-neon-y-humo_3250x1828_xtrafondos.com.jpg" class="img-fluid" alt="fondo">
        </div>
        <div class="forminicial card-img-overlay " >
            <br>
            <br>
            <div>
                <form action="/Modelo/crearRandom.php" method="post">
                <input class=" text-center d-block mx-auto" type="text" name="code" value="<?php echo $clave; ?>"/>
                </form>
            </div>
            
            <br>
            <div class="input-group mb-3 "><button onclick="alert('Código copiado al portapapeles');" class="btn btn-primary text-center d-block mx-auto">Copiar Código Partida</button></div>
            <br>
            <div><a href="crearavatar.html"><button class="btn btn-primary text-center d-block mx-auto">Jugar</button></a></div>
        </div>
        <div class="container centro">
            Copyright &copy Equipo Senasoft SIIGO CBC 2021

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
</body>
</html>