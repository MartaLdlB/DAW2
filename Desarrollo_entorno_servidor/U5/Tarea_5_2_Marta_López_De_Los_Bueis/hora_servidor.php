<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        function pintarHora(){
           let  xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("hora").innerHTML = "Hora en el servidor: "+ this.response;
            }
            };
            	xhttp.open("GET", "hora_servidor.php", true);
            xhttp.send(); 
        }
        setInterval(pintarHora, 2000);
        
    </script>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">

        <label for="hora" id="hora"></label>
        
    </form>
</body>
</html>


<?php
    echo date('H:i:s'); 
?>