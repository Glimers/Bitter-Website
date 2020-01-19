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
        // put your code here
        //1.
        $var1 = 10;
        $var2 = 10;
        if($var1 === $var2){
            echo "Equal<br>";
        }
        else{
            echo "not equal<br>";
        }
        
        echo ($var1 == $var2) ? "Equal<br>" :"not equal<br>";
        
        ?>
        
        
        <table border="2px">
        <?php //code of echo'd the table echo "<table border='1'>";
        //2.
        $number1 = 1;
        $number2 = 1;
        
        while($number1<8){
            echo "<tr>";
            while($number2 < 8){
                echo "<td>";
                echo $number1 * $number2 . " ";
                $number2++;
            }
            echo "<br>";
            $number1++;
            $number2 = 1;
        }
        
        
        
        
        ?>
        </table>
        
        <table border="2px">
            
            <?php
                echo "<tr><td style=\"color:blue\">Apples cost<td>$4<tr><td style=\"color:blue\">Oranges Cost<td>$1.99<tr><td style=\"color:blue\">Bananas cost<td>$0.89";
            ?>
            
        </table>
    </body>
</html>
