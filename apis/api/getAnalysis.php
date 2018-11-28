<?php
include '../headl.inc.php';
if(isset($_GET['year'])){

$dat = '';

    $bidangs = getArea();
    $t = '[';
    while($bid=$bidangs->fetch_assoc())
    {
        $t = $t.getStudentAnalysisByYearAndArea($_GET['year'], $bid['id']).',';
    }
    $t = substr($t, 0,-1).']';
    echo $t;
}else    return NULL;
