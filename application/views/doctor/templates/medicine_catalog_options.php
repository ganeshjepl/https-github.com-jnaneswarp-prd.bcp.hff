<?php 
foreach($options as $option){
    ?>
<option id='<?php echo $option['id']; ?>' data-dosage="<?php echo $option['dosage']; ?>" value='<?php echo $option['id']; ?>'><?php echo $option['name']; ?></option>
<?php
}
?>