<?php
echo <<<HTML
    <a href="ADD_music">add +</a><br>
HTML;
foreach($tracks as $track){
    echo <<<HTML
    <div style="border: solid;">
        <h1>{$track['name']}<h1>
        <form method="post" action = "EDIT_music">
            <input type="hidden" name="id" value="{$track['id']}">
            <button type = "submit">edit</button>
        </form>
        <form method="post" action = "DEL_music">
            <input type="hidden" name="id" value="{$track['id']}">
            <button type = "submit">del</button>
        </form>
    </div>
HTML;
}
