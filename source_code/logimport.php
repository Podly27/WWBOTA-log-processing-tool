<?php
include "top.php";
?>

<h3>File Upload</h3>
<form method="post"  enctype="multipart/form-data">

<input type="file" name="uploaded" >
<input type="submit" value="Upload">

</form>

<?php

if(!isset($_FILES["uploaded"]["tmp_name"]))
    exit();

include "adif_parser.php";


// $_FILES["uploaded"]["tmp_name"]

echo "File: " . $_FILES["uploaded"]["tmp_name"];


$p = new ADIF_Parser;
$p->load_from_file($_FILES["uploaded"]["tmp_name"]);
$p->initialize();

$import = 1;

while($record = $p->get_record())
{
    if(count($record) == 0)
    {
        break;
    }


    echo "<br> My callsign " . $record["station_callsign"];
    echo " - " . $record["call"];
    echo " - " . $record["qso_date"] . $record["time_on"];

    echo "<br>";

    $record_clean = array();

    foreach ($record as $key => $value){
         $record_clean[$key] = addslashes($value);
    }

    $query = "INSERT IGNORE INTO logstore (`" . join("`,`", array_keys($record_clean)) . "`) VALUES ('" . join("','", $record_clean) . "');";
    echo $query;
    $result = $db->query($query);
    echo $result->error;
    echo "Imported: $import";
    $import++;
}

?>
