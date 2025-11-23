<?php
echo <<<HTML
<form method="post" action="ADD_musician" enctype="multipart/form-data">
    <h2>Add a Musician</h2>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" maxlength="100" required><br><br>
    
    <label for="instrument_s">Instrument(s):</label><br>
    <input type="text" id="instrument_s" name="instrument_s" maxlength="200" required><br><br>
    
    <label for="img_PATH">Image:</label><br>
    <input type="file" id="img_PATH" name="img_PATH" maxlength="500" accept="image/*" required><br><br>
    
    <label for="birth">Birth Date:</label><br>
    <input type="date" id="birth" name="birth" required><br><br>
    
    <label for="death">Death Date (optional):</label><br>
    <input type="date" id="death" name="death"><br><br>
    
    <input type="submit" value="Add Musician">
    <a href="musicians">cancel</a>
</form>
HTML;
?>
