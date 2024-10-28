<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="español">Español</label>    
        <input type="checkbox" name="español" id="es">
        <br>
        <label for="ingles">Ingles</label>    
        <input type="checkbox" name="ingles" id="in">
        <br>
        <label for="japones">Japones</label>    
        <input type="checkbox" name="japones" id="ja">
    </form>
    <br>
    <p><?php echo $texto[$idioma]; ?></p>




<?php

$idioma="es"; //en este caso la pagina empezará en español
if(isset($_COOKIE["idioma"])){
    $idioma=$_COOKIE["idioma"];
}
if($_SERVER['REQUEST_METHOD']==='POST'){

    //Elegimos el idioma mediante un formulario
    $idioma=$_POST['idioma'];

    setcookie("idioma",$idioma);
    
    //Recargamos la pagina
    header("Location: ".$_SERVER['PHP_SELF']);
}

$texto = [

    'es' => [
        'Durante mil años han caído las cenizas y nada florece. 
        Durante mil años los skaa han sido esclavizados y viven sumidos en un miedo inevitable. 
        Durante mil años el Lord Legislador reina con un poder absoluto gracias al terror, a sus poderes e inmortalidad. 
        Le ayudan «obligadores» e «inquisidores», junto a la poderosa magia de la «alomancia». 
        Pero los nobles, con frecuencia, han tenido trato sexual con jóvenes skaa y, 
        aunque la ley lo prohíbe, algunos de sus bastardos han sobrevivido y heredado los poderes alománticos: 
        son los «nacidos de la bruma» (mistborns). Ahora, Kelsier, el «superviviente», el único que ha logrado 
        huir de los Pozos de Hathsin, ha encontrado a Vin, una pobre chica skaa con mucha suerte... Tal vez los dos unidos 
        a la rebelión que los skaa intentan desde hace mil años puedan cambiar el mundo y la atroz dominación del Lord Legislador.'
    ],
    'in' => [
        'For a thousand years ashes have fallen and nothing blooms. 
        For a thousand years the skaa have been enslaved and live in unavoidable fear. 
        For a thousand years the Lord Ruler reigns with absolute power thanks to terror, 
        his powers and immortality. He is helped by "obligors" and "inquisitors", along with the powerful magic of "Allomancy". 
        But nobles have often had sexual intercourse with young skaa and, although the law prohibits it, 
        some of their bastards have survived and inherited allomantic powers: they are the "mistborns." 
        Now, Kelsier, the "survivor", the only one who has managed to escape from the Wells of Hathsin, 
        has found Vin, a poor skaa girl with a lot of luck... Perhaps the two of them joined the rebellion that the skaa have been trying for a long time. 
        A thousand years can change the world and the atrocious domination of the Lord Ruler.'
    ],
    'ja' => [
        '千年の間、灰は降り、何も咲かない。千年にわたり、スカアは奴隷として扱われ、
        避けられない恐怖の中で暮らしてきました。千年にわたり、支配者は恐怖、その力、
        そして不死のおかげで絶対的な権力を持って君臨します。彼は「債務者」と「異端審問官」、
        そして強力な魔法「アロマンシー」に助けられる。しかし、貴族はしばしば若いスカアと性行為を行っており、
        法律で禁止されているにもかかわらず、彼らのろくでなしの中には生き残ってアロマンティックな力を受け継いだ者もいる。
        彼らは「ミストボーン」である。さて、ハシンの井戸から逃げ出した唯一の「生存者」であるケルシャーは、
        幸運にも貧しいスカアの少女ヴィンを見つけた…おそらく二人はスカアの反乱に加わったのだろう。
        長い間努力してきました。千年もあれば世界も、支配主の残虐な支配も変えることができる。'
    ]

    ];


?>

</body>
</html>