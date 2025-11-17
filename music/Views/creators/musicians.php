<?php
echo <<<HTML
    <a href="ADD_musician">add +</a><br>
    <a href="EDIT_musician">edit</a>
    <form method="post" action = "DEL_musician">
        <button type = "submit">del</button>
    </form>
HTML;