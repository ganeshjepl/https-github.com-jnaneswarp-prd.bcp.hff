<?php 
foreach($options as $option){
    ?>
<option id='<?php echo $option['id']; ?>' value='<?php echo $option['id']; ?>'><?php echo $option['firstName'].' '.$option['lastName']; ?></option>
<?php
}
?>