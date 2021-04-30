


<header>
    <div id="menu">
        <nav>
            <ul class="navgroup">
                <li><a href="index.php">Home</a></li>
                <?php
                if(empty($_SESSION['id'])){
                    echo "<li><a href=\"login.php\">Login/Register</a></li>";
                }else{
                    echo "<li><a href=\"createpost.php\">Create Post</a></li>";
                    echo "<li><a href=\"messaging.php\">Messaging</a></li>";
                    echo "<li><a href=\"../php/logout.php\">Logout</a></li>";
                }
                ?>
                <?php
                if(!empty($_SESSION['id'])){
                    echo "<li style=\"float: right; color: white;\">".$_SESSION['username'];"</li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
