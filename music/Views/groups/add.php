<?php


echo <<<HTML
<form method="post" action="ADD_band_save" enctype="multipart/form-data">
    <h2>Create a Band</h2>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" maxlength="100" required><br><br>

    <label for="img_PATH">Band image:</label><br>
    <input type="file" id="img_PATH	" name="img_PATH" maxlength="500" accept="image/*" required><br><br>

    <label for="musician">Name:</label><br>
    <select name="musicians[]" multiple>
HTML;
foreach($creators as $creator){
    echo <<<HTML
    <option value="{$creator['id']}">{$creator['name']}</option>
    HTML;
}
echo <<<HTML
    </select><br><br>
    
    <input type="submit" value="Create Band">
    <a href="bands">cancel</a>
</form>
HTML;