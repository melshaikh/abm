<?php
include '../headl.inc.php';
        $ar = getArea();
        $areas = NULL;
        $years = NULL;
        while($a = $ar->fetch_assoc())
        {
            $z = array("id"=>$a['id'],"name"=>$a['name']);
            $areas[] = $z;
        }
        $ys = getYears();
        while($a = $ys->fetch_assoc())
        {
            $z = array("id"=>$a['id'],"name"=>$a['name']);
            $years[] = $z;
        }
        
        $aaa = json_encode($areas,JSON_UNESCAPED_SLASHES);
        $yyy = json_encode($years,JSON_UNESCAPED_SLASHES);
        echo ('{"years":'.$yyy.',"areas":'.$aaa.' }');
