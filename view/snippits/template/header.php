<?php

if ($this->user->authenticated === false) {

    echo "
    <li class='nav-item active'>
        <a class='nav-link' href='/'>Home<span class='sr-only'>(current)</span></a>
    </li>
    ";

} else {

    echo "
    <li class='nav-item active'>
        <a class='nav-link' href='/'>Home <span class='sr-only'>(current)</span></a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/health/'>Health</a>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Profile</a>
                <div class='dropdown-menu' aria-labelledby='dropdown01'>
                    <a class='dropdown-item' href='/profile/'>My Profile</a>
                    <a class='dropdown-item' href='/profile/edit''>Edit Profile</a>
                </div>
        </li>
    ";


}


?>




