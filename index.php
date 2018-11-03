<?php
include_once 'core/init.php';
if(isset($_SESSION['name'])){
    echo "Welcome " .  $_SESSION['name'] . "</br>" ;
   echo " <a href ='logout.php'>Logout</a></br>" ;
}else {
    echo "<a href ='loginW.php'>Login</a></br>";
    echo "<a href ='registerW.php'>Register</a>";
}
?>


<form role="search" action="results.php" method="POST">
    <div class="search-control">
        <input type="search" id="site-search" name="criteria"
               placeholder="Find user">
        <button>Search</button>
    </div>
</form>

