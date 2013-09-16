<?php

$content = '<h2>results are not stored</h2>';
$form = '

<form method="post" action="">
<label for="name">
Name
</label>
<input type="text" name="name" id="name" value="'.$_POST['name'].'">
<br />

<label for="number">
Number
</label>
<input type="text" name="number" id="number" value="'.$_POST['number'].'">
<br />

<label for="submit">
Submit
</label>
<input type="submit" name="submit" id="submit">
';

if (!empty($_POST)){

    if (empty($_POST['name'])){
       $content.='<h3>Please complete your name<h3>';
    }
    if (empty($_POST['number'])){
       $content.='<h3>Please complete your number<h3>';
    }

    if (!empty($_POST['name']) && !empty($_POST['number'])){
       $content.='<h3>Thankyou '.$_POST['name'].' for completing the form</h3>';
    } else {
       $content.=$form;
    }



} else {

$content.=$form;
}




echo $content;


?>



