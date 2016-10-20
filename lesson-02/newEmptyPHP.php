<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <p>
        <?php            
            $list = [
                '<a> - anchor',
                '<p> - paragraph',
                '<ul> - unordered list',
                '<table> - table'
            ];

            foreach($list as $value) {
                $explodedValue = explode(" - ", $value);
                echo htmlspecialchars($explodedValue[0]) . "&emsp;" . $explodedValue[1] . "<br>";
            }   
        ?>
        </p>
    </body>
</html>
