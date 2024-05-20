<?php
$file = 'id.json';
if (file_exists($file)) {
    $handle = fopen($file, 'w');
    if ($handle) {
        
        fwrite($handle, '');
       
        fclose($handle);
    } else {
        echo "Napaka pri odpiranju datoteke.";
        exit;
    }
} else {
    echo "Datoteka ne obstaja.";
    exit;
}

header("Location: index.html");
exit;
?>
