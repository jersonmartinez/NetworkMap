<script type="text/javascript" src="network/dist/vis.js"></script>
<link href="network/dist/vis-network.min.css" rel="stylesheet" type="text/css" />

<?php
    @session_start();
    if ($_SESSION['call'] != "off"){
        include ("php/ssh.class.php");
        $CN = new ConnectSSH();
    }

    include ("getData.php");

?>