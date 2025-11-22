<?php
echo <<<HTML
<form method="post" action="EDIT_band_save">
    <input name="id" type="hidden" value="{$band['id']}">
    <h2>Change The Band</h2>
    
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" maxlength="100" value="{$band['name']}" required><br><br>
    
    <label for="musician">Name:</label><br>
    <select name="musicians[]" style="width: 200px" multiple required>
HTML;
foreach($members as $member){
    if(count(array_intersect([$member["id"]], $members_id)) > 0){
        echo <<<HTML
        <option value="{$member['id']}" selected>{$member['name']}</option>
        HTML;
    }
    else {
        echo <<<HTML
        <option value="{$member['id']}">{$member['name']}</option>
        HTML;
    }
}
echo <<<HTML
    </select><br><br>

    <input type="submit" value="Edit Musician">
    <a href="bands">cancel</a>
</form>
HTML;
?>
