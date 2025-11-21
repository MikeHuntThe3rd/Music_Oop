<?php

echo <<<HTML
    <a href="ADD_band">add +</a><br>
    <a href="home">Home Page</a>
HTML;
foreach($groups as $group){
    echo <<<HTML
    <div style="border: solid;">
        <h1>{$group['name']}<h1>
        <form method="post" action = "EDIT_band">
            <input type="hidden" name="id" value="{$group['id']}">
            <button type = "submit">edit</button>
        </form>
        <form method="post" action = "DEL_band">
            <input type="hidden" name="id" value="{$group['id']}">
            <button type = "submit">del</button>
        </form>
    </div>
HTML;
}
