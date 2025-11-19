<?php
echo <<<HTML
    <a href="ADD_music">add +</a><br>
HTML;
foreach($trackss as $tracks){
    echo <<<HTML
    <div style="border: solid;">
        <h1>{$tracks['name']}<h1>
        <form method="post" action = "EDIT_music">
            <input type="hidden" name="id" value="{$tracks['id']}">
            <button type = "submit">edit</button>
        </form>
        <form method="post" action = "DEL_music">
            <input type="hidden" name="id" value="{$tracks['id']}">
            <button type = "submit">del</button>
        </form>
    </div>
HTML;
}
