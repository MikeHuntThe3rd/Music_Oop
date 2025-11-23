<?php
$prev = basename($creator['img_PATH']);
echo <<<HTML
<form method="post" action="EDIT_musician_save" enctype="multipart/form-data">
    <input name="id" type="hidden" value="{$id['id']}">
    <h2>Edit The Musician</h2>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" maxlength="100" value="{$creator['name']}" required><br><br>
    
    <label for="instrument_s">Instrument(s):</label><br>
    <input type="text" id="instrument_s" name="instrument_s" maxlength="200" value="{$creator['instrument_s']}" required><br><br>
    
    <label for="img_PATH">Image Path: (prev: {$prev})</label><br>
    <input type="file" id="img_PATH" name="img_PATH" maxlength="500" accept="image/*" required><br><br>
    
    <label for="birth">Birth Date:</label><br>
    <input type="date" id="birth" name="birth" value="{$creator['birth']}" required><br><br>
    
    <label for="death">Death Date (optional):</label><br>
    <input type="date" id="death" name="death" value="{$creator['death']}"><br><br>
    
    <input type="submit" value="Edit Musician">
    <a href="musicians">cancel</a>
</form>
HTML;
?>
