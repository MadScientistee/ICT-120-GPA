<?php
/**
 * File : store.php: stores the data of the form in a javascript reload file
 *
 * Author : X. Carrel
 * Created : 2020-05-05
 * Modified last :
 **/

// Assumptions:
// 1. All input fields are arrays, i.e: <input name='input[15]' ...
// 2. All input fields have an id that corresponds to the index, i.e: <input name='input[15]' id='input15'

if (isset($_POST['cmdSave'])) {
    $fp = fopen('reload.js', 'w');
    foreach($_POST as $fkey => $post) {
        foreach ($post as $ikey => $value) {
            if (strlen($value) > 0) {
                fwrite($fp, "$fkey$ikey.value = '$value'\n");
            }
        }
    }

    // Another ugly trick to keep the main file as simple as possible
    fwrite($fp,"
    // Load image tags with the name in the input field
    document.querySelectorAll(\".actimg\").forEach(img => {
        img.src = document.getElementById('txt'+img.id.substring(3)).value
    });
    ");
    fclose($fp);
}
?>
