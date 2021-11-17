<nav>
    <div class="navbar">
        <a class="<?php
        if (PATH_PARTS['filename'] == "index"){
            print'activePage'; 
        }
        ?>" href="index.php">Home</a>

        <a class="<?php
        if (PATH_PARTS['filename'] == "about"){
            print'activePage'; 
        }
        ?>" href="about.php">About</a>

        <a class="<?php
        if (PATH_PARTS['filename'] == "contact"){
            print'activePage'; 
        }
        ?>" href="contact.php">Contact</a>

        <div class="dropdown">
            <button class="dropbtn">Admin
                <i class="fa fa-caret-down"></i>
            </button> 
            <div class="dropdown-content">
                <a href="wildlifeForm.php">Insert New Wildlife</a>
                <a href="updateList.php?action=u">Update Wildlife</a>
                <a href="updateList.php?action=d">Delete Wildlife</a>
            </div>
        </div>
    </div>
</nav>
