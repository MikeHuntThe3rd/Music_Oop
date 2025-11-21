<?php
echo <<<HTML
    <a href="ADD_musician">add +</a><br>
    <a href="home">Home Page</a>
HTML;
foreach($creators as $creator){
    echo <<<HTML
    <div style="border: solid;">
        <h1>{$creator['name']}<h1>
        <form method="post" action = "EDIT_musician">
            <input type="hidden" name="id" value="{$creator['id']}">
            <button type = "submit">edit</button>
        </form>
        <form method="post" action = "DEL_musician">
            <input type="hidden" name="id" value="{$creator['id']}">
            <button type = "submit">del</button>
        </form>
    </div>
HTML;
}
