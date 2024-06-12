<?php
include "../../Requetes/fetch.php";
if (isset($_POST['param'])) {
    $param = $_POST['param'];
} else {
    header('Location:../index.php');
}
if (isset($_POST['count'])) {
    $count = $_POST['count'];
} else {
    header('Location:../index.php');
}
if (isset($_POST['sql'])) {
    $sql = $_POST['sql'];
} else {
    header('Location:../index.php');
}
if (isset($_POST['annee'])) {
    $annee = $_POST['annee'];
} else {
    header('Location:../index.php');
}
if (isset($_POST['mois'])) {
    $mois = $_POST['mois'];
    echo $mois;
} else {
    header('Location:../index.php');
}
if (isset($_POST['valeur'])) {
    $valeur = $_POST['valeur'];
} else {
    header('Location:../index.php');
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 'Arretes-et-decisions') {
        $tableau = fetchArretes($mois, $annee, $sql, $count, $param);
    } elseif ($_POST['type'] == 'Accords-cadres') {
        $tableau = fetchAccords($mois, $annee, $sql, $count, $param);
    } elseif ($_POST['type'] == 'Conventions') {
        $tableau = fetchConventions($mois, $annee, $sql, $count, $param);
    } elseif ($_POST['type'] == 'Marches') {
        $tableau = fetchMarches($mois, $annee, $sql, $count, $param);
    } else {
        header('Location:../index.php');
    }
} else {
    header('Location:../index.php');
}
download_send_headers("data_export_" . $_POST['type'] . "_" . $valeur . ".csv");
echo array2csv($tableau);

function array2csv(array &$array)
{
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
}

function download_send_headers($filename)
{
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}


?>