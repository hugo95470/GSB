<?php
//param :(si plusirurs, séparer par une virgule, sans espace)
//PRA_NUM,PRA_NOM,PRA_CP
//Description : (sur une ligen seulement)
//Récuperer tous les infos des praticiens si aucun param, avec param, récupère les infos du praticien demandé (en fonction du nom ou de l'Id)

require '../_conf.php';
$PRA_NUM  = filter_input(INPUT_POST, 'param1');
$PRA_NOM  = filter_input(INPUT_POST, 'param2');
$PRA_CP  = filter_input(INPUT_POST, 'param3');


if(empty($PRA_NUM)){
    $PRA_NUM  = filter_input(INPUT_GET, 'PRA_NUM');

}

if(empty($PRA_NOM)){
    $PRA_NOM  = filter_input(INPUT_GET, 'PRA_NOM');

}

if(empty($PRA_CP)){
    $PRA_CP  = filter_input(INPUT_GET, 'PRA_CP');

}

if(!empty($PRA_NUM)){
    $reqNameUser = 'SELECT * FROM PRATICIEN WHERE PRA_NUM = ?';
    $stmt = $pdo->prepare($reqNameUser);
    $stmt->bindParam(1, $PRA_NUM, PDO::PARAM_INT);
    $stmt->execute();
    $MED_INFO = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($MED_INFO);
}else if(!empty($PRA_CP)){
    $reqNameUser = 'SELECT * FROM PRATICIEN WHERE PRA_CP LIKE "%'.$PRA_CP.'%"';
    $stmt = $pdo->prepare($reqNameUser);
    $stmt->bindParam(1, $PRA_NUM, PDO::PARAM_STR);
    $stmt->execute();
    $MED_INFO = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($MED_INFO);
}else if(!empty($PRA_NOM)){
    $reqNameUser = 'SELECT * FROM PRATICIEN WHERE PRA_NOM LIKE "%'.$PRA_NOM.'%"';
    $stmt = $pdo->prepare($reqNameUser);
    $stmt->bindParam(1, $PRA_NUM, PDO::PARAM_STR);
    $stmt->execute();
    $MED_INFO = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($MED_INFO);
}else{
    $reqNameUser = 'SELECT PRA_NOM FROM PRATICIEN';
    $stmt = $pdo->prepare($reqNameUser);
    $stmt->execute();
    $MED_NOMS = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $json = json_encode($MED_NOMS);
    $json = str_replace("," , ", ", $json);

    echo $json;
}



