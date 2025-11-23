<?php
echo <<<HTML
    <form action="EDIT_music_save" method="post">
        <h2>Add a Music</h2>
        <input name="id" type="hidden" value="{$id}">

        <label for="name">Track Name:</label><br>
        <input type="text" id="name" name="name" value="{$row['name']}" required><br><br>

        <label for="track_PATH">Track File:</label><br>
        <input type="text" id="track_PATH" name="track_PATH" value="{$row['track_PATH']}" required><br><br>

        <label for="icon_PATH">Icon Image (optional):</label><br>
        <input type="text" id="icon_PATH" name="icon_PATH" value="{$row['icon_PATH']}"><br><br>

        <label for="album">Album (optional):</label><br>
        <input type="text" id="album" name="album" value="{$row['album']}"><br><br>

        <label for="creator_id">creator_id:</label><br>
        <select id="creator_id" name="creator_id" required>
HTML;
        foreach($creators as $creator){
            if($creator["id"] != $row["creator_id"]){
                echo <<<HTML
                <option value="{$creator['id']}">{$creator['musician_id']}, {$creator['band_id']}</option>
                HTML;
            }
            else{
                echo <<<HTML
                <option value="{$creator['id']}" selected>{$creator['musician_id']}, {$creator['band_id']}</option>
                HTML;
            }
        }
        echo <<<HTML
        </select><br><br>
        <input type="submit" value="Add Music">
        <a href="music">cancel</a>
    </form>
HTML;