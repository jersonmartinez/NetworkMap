<script type="text/javascript" src="network/dist/vis.js"></script>
<link href="network/dist/vis-network.min.css" rel="stylesheet" type="text/css" />

<?php
    @session_start();
    if ($_SESSION['call'] != "off"){
        include ("php/ssh.class.php");
        $CN = new ConnectSSH();
    }

    ?>
        <script type="text/javascript">
            var nodes = null;
            var edges = null;
            var network = null;

            var DIR = 'network/img/refresh-cl/news/';
            var EDGE_LENGTH_MAIN = 150;
            var EDGE_LENGTH_SUB = 50;

            // Called when the Visualization API is loaded.
            function draw() {
                // Create a data table with nodes.
                nodes = [];

                var main = "Mainframe";
                var change = "Server";

                var arrayNet    = "192.168.100.0/24";
                //var arrayNet    = ["192.168.0.0/24", "192.168.1.0/24", "192.168.2.0/24"];
                var arrayHost = ["192.168.0.2", "192.168.0.3", "192.168.0.4", "192.168.0.5"];
                var arrayHost = ["192.168.2.2", "192.168.2.3", "192.168.2.4"];
                var arrayRouter = ["192.168.100.1, 192.168.101.1"];

                LongArrayNet  = arrayNet.length;
                LongArrayHost = arrayHost.length;
                LongArrayRou  = arrayRouter.length; 

                  // Create a data table with links.
                edges = [];

                //nodes.push({id: 1, label: change, image: DIR + 'server.png', shape: 'image'});
                //nodes.push({id: 2, label: arrayNet, image: DIR + 'switch.png', shape: 'image'});

                <?php
                    $getMyIPServer  = $CN->getMyIPServer();
                    $ReturnIPNets   = $CN->getIPNet();

                    if ($ReturnIPNets->num_rows > 0){
                        while ($RIP = $ReturnIPNets->fetch_array(MYSQLI_ASSOC)){
                            // $RIPValue = explode(".", $RIP['ip_net'])[2];
                            $RIPValue = implode("", explode("/", implode("", explode(".", $RIP['ip_net']))));
                            $Switches = $CN->getHostTypeSwitch($RIP['ip_net']);

                            if ($Switches->num_rows >= 2){
                                ?>
                                    nodes.push({id: <?php echo $RIPValue; ?>, label: "<?php echo $RIP['ip_net']; ?>", image: DIR + 'switchicon4.png', shape: 'image'});
                                <?php
                            }
                        }
                    }
                ?>

                 <?php
                    $Routers = $CN->getHostTypeRouter();
                    while ($RRouter = $Routers->fetch_array(MYSQLI_ASSOC)){
                        $IDRouter = implode("", explode(".", $RRouter['ip_host']));
                        // $IDRouter = implode("", explode(".", implode("", explode("/", $RRouter['net_next']))));
                        $RIPValueSwitch = implode("", explode("/", implode("", explode(".", $RRouter['ip_net']))));
                        // $IDValueSwitch  = implode("", explode(".", $RRouter['ip_net']));
                        ?>
                            nodes.push({id: <?php echo $IDRouter; ?>, label: "<?php echo $RRouter['net_next']; ?>", image: DIR + 'routercisco1.png', shape: 'image'});
                            
                            // edges.push({from: <?php echo $IDRouter; ?>, to: <?php echo $RIPValueSwitch; ?>, length: EDGE_LENGTH_SUB});
                        <?php
                    }


                ?>

                <?php
                    $Machines = $CN->getHostTypeHost();
                    while ($rm = $Machines->fetch_array(MYSQLI_ASSOC)){
                        $RMValue        = implode("", explode(".", $rm['ip_host']));
                        $RMValueSwitch  = implode("", explode("/", implode("", explode(".", $rm['ip_net']))));

                        if ($getMyIPServer == $rm['ip_host']){
                            ?>
                                nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $rm['ip_host']; ?>", image: DIR + 'server1.png', shape: 'image'});
                            
                                
                                // edges.push({from: <?php echo $RMValue; ?>, to: <?php echo $RMValueSwitch; ?> , length: EDGE_LENGTH_SUB});
                            <?php
                        } else {
                            ?>
                                nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $rm['ip_host']; ?>", image: DIR + 'laptop1.png', shape: 'image'});
                        
                            
                                // edges.push({from: <?php echo $RMValue; ?>, to: <?php echo $RMValueSwitch; ?> , length: EDGE_LENGTH_SUB});
                            <?php
                        }

                    }
                ?>

                <?php
                    $ExtgetIPNet = $CN->getIPNet();

                    if ($ExtgetIPNet->num_rows > 0){
                        while ($ExtGIPN = $ExtgetIPNet->fetch_array(MYSQLI_ASSOC)){
                            // $ExtGIPNValue = explode(".", $ExtGIPN['ip_net'])[2];
                            $ExtGIPNValue   = implode("", explode("/", implode("", explode(".", $ExtGIPN['ip_net']))));
                            $Switches       = $CN->getHostTypeSwitch($ExtGIPN['ip_net']);

                            if ($Switches->num_rows >= 2){

                                // echo "<br/>Network: ".$ExtGIPN['ip_net']." | ID Network: ".$ExtGIPNValue."<br/>";

                                $RecorrerHosts = $CN->getHostNetwork($ExtGIPN['ip_net']);

                                if ($RecorrerHosts->num_rows > 0){
                                    while ($RH = $RecorrerHosts->fetch_array(MYSQLI_ASSOC)){
                                        $RHValue = implode("", explode(".", $RH['ip_host']));
                                        // echo "Host: ".$RH['ip_host']." Cambio: ".$RHValue."<br/>";
                                        ?>
                                            edges.push({from: <?php echo $RHValue; ?>, to: <?php echo $ExtGIPNValue; ?>, length: EDGE_LENGTH_SUB});
                                        <?php
                                    }
                                }
                                
                            } else if ($Switches->num_rows == 1){
                                $getHT = $CN->getHostTypeHost();
                                if ($getHT->num_rows > 0){
                                    while ($rowGetHT = $getHT->fetch_array(MYSQLI_ASSOC)){

                                        $SFindRouterNext = $CN->getHostTypeRouter();
                                        while ($SResultadin = $SFindRouterNext->fetch_array(MYSQLI_ASSOC)){
                                            if ($rowGetHT['ip_net'] == $SResultadin['net_next']){

                                                $MyIDNetNext = implode("", explode(".", $rowGetHT['ip_host']));
                                                $OtherRouter = implode("", explode(".", $SResultadin['ip_host']));

                                                ?>
                                                    edges.push({from: <?php echo $MyIDNetNext; ?>, to: <?php echo $OtherRouter; ?>, length: EDGE_LENGTH_SUB});
                                                <?php
                                                goto Finalizando;
                                            }
                                        }
                                        
                                    }
                                }

                                Finalizando:
                                    break;

                            }
                        }
                    }

                    $LastRouter = $CN->getHostTypeRouterLast();
                    if ($LastRouter->num_rows > 0){
                        $LastRouterDato = $LastRouter->fetch_array(MYSQLI_ASSOC);
                        $IDLastRouter = implode("", explode(".", $LastRouterDato['ip_host']));
                        $LastRouterSwitch = implode("", explode("/", implode("", explode(".", $LastRouterDato['net_next']))));

                        ?>
                            edges.push({from: <?php echo $LastRouterSwitch; ?>, to: <?php echo $IDLastRouter; ?>, length: EDGE_LENGTH_SUB});
                            // edges.push({from: 192168101024, to: 1921681012, length: EDGE_LENGTH_SUB});
                        <?php
                        // echo "ID: ".$IDLastRouter." | LastRouterSwitch: ".$LastRouterSwitch."<br/>";
                    }


                    //Recorremos los enrutadores para saber quienes son los siguientes conectados.
                    $TypeRouter = $CN->getHostTypeRouter();
                    if ($TypeRouter->num_rows > 0){

                        while ($TypeRouterDato = $TypeRouter->fetch_array(MYSQLI_ASSOC)){
                            $MyNetNext = $TypeRouterDato['net_next'];

                            //Se recorre nuevamente la misma tabla para averiguar

                            $FindRouterNext = $CN->getHostTypeRouter();
                            while ($Resultadin = $FindRouterNext->fetch_array(MYSQLI_ASSOC)){
                                if ($MyNetNext == $Resultadin['ip_net']){

                                    $MyIDNetNext = implode("", explode(".", $TypeRouterDato['ip_host']));
                                    $OtherRouter = implode("", explode(".", $Resultadin['ip_host']));

                                    ?>
                                        edges.push({from: <?php echo $MyIDNetNext; ?>, to: <?php echo $OtherRouter; ?>, length: EDGE_LENGTH_SUB});
                                    <?php
                                }
                            }
                        }
                        
                        // echo "ID: ".$IDLastRouter." | LastRouterSwitch: ".$LastRouterSwitch."<br/>";
                    }
                ?>


              // create a network
              var container = document.getElementById('mynetwork');
              var data = {
                nodes: nodes,
                edges: edges
              };
              var options = {};
              network = new vis.Network(container, data, options);
            }
        </script>

        <input type="button" style="float: right" id="ClickSondeoFinal" onclick="javascript: draw();" value="Cambiar panorama" />
        <div ondblclick="javascript: draw();" id="mynetwork" style="width: 100%; height: 450px; border: 1px solid lightgray;"></div>