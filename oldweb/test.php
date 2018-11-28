<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['login']))
            {
            if(isset($_POST['std_list']))
               $std_list = count($_POST['std_list']);
                    foreach($_POST['std_list'] as $value)
                    echo $value;
                
            }
        ?>
    </body>
</html>
