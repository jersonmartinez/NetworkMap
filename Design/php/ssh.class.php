<?php
	class ConnectSSH {
		public $ip_host;
		private $username;
		private $password;
		public $connect;
		private $stream;
		private $errors = array();
		private $local_path = "/var/www/html/NetworkAdmin/php/";
		private $remote_path;
		private $filename;

		function __construct($ip_host, $username, $password){
			if (!function_exists("ssh2_connect")) {
        		array_push($this->errors, "La función ssh2_connect no existe");
			}

        	if(!($this->connect = @ssh2_connect($ip_host, 22))){
				$this->ip_host = $ip_host;
        		array_push($this->errors, "No hay conexión con al dirección IP: " . $ip_host);
		    } else {
		        if(!ssh2_auth_password($this->connect, $username, $password)) {
        			array_push($this->errors, "Autenticación invalida");
		        } else {
					$this->ip_host 		= $ip_host;
					$this->username 	= $username;
					$this->password 	= $password;
					$this->remote_path 	= "/home/".$username."/";
		        }
		    }
		}

		public function RunLines($RL){
			if(!($this->stream = ssh2_exec($this->connect, $RL)))
		        return "Falló: El comando no se ha podido ejecutar.";
			stream_set_blocking($this->stream, true);
            while ($buf = fread($this->stream, 4096))
                $data .= $buf;
            
            if (fclose($this->stream))
            	return $data;
		}

		public function writeFile($Instructions, $filename){
			$inputfile = file_put_contents($this->local_path.$filename, implode("\n", $Instructions));
			if ($inputfile === false)
				die("El script <b>".$filename."</b>, no se ha podido crear.");
			@chmod($this->local_path.$filename, 0777);
		
			return true;
		}

		public function sendFile($filename){
			$scp = ssh2_scp_send($this->connect, $this->local_path.$filename, $this->remote_path.$filename, 0777);
			if (!$scp){
				return false;
			} else {
				return true;
			}
		}

		public function recvFile($remotePath){
			$scp = ssh2_scp_recv($this->connect, $remotePath, "/Backups");
			if (!$scp){
				return false;
			} else {
				return true;
			}
		}

		public function deleteFile($filename){
			if (!unlink($this->local_path.$filename))
				return false;
			return true;
		}

		public function CreateBackup($arguments){
			$filename = "CreateBackup.sh";
			$ActionArray[] = 'CurrentDate=$(date +"%d-%b-%Y")';
			array_push($ActionArray, 'CurrentDateFormat=$(date +"%d%m%Y")');
			array_push($ActionArray, 'CurrentDateTime=$(date +"%H%M")');
			array_push($ActionArray, 'HostName=$(hostname)');
			array_push($ActionArray, 'PathAbsolute="Backups"');
			array_push($ActionArray, 'DirStorage=$(printf "/%s/%s/%s_%s_%s" $PathAbsolute $CurrentDate $HostName $CurrentDateFormat $CurrentDateTime)');
			array_push($ActionArray, 'DirCompact=$(printf "%s_%s_%s" $HostName $CurrentDateFormat $CurrentDateTime)');
			array_push($ActionArray, 'function CreateDirs(){');
			array_push($ActionArray, '	[ ! -d $DirStorage ] && mkdir -p ${DirStorage}');
			array_push($ActionArray, '	chmod 0777 -R -f $(dirname $(dirname $DirStorage))');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function VerifyService(){');
			array_push($ActionArray, '	PackService=$(ps ax | grep -v grep | grep ${1})');
			array_push($ActionArray, '	if [[ $PackService != "" ]]; then');
			array_push($ActionArray, "		echo 'Well'");
			array_push($ActionArray, '	else');
			array_push($ActionArray, "		echo 'bad'");
			array_push($ActionArray, "	fi");
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function BackupApache(){');
			array_push($ActionArray, '	Service="apache"');
			array_push($ActionArray, '	if [ `VerifyService apache2` == "Well" ]; then');
			array_push($ActionArray, '		PathApacheArray=("/usr/lib/apache2" "/etc/apache2" "/usr/share/apache2" "/etc/ssl/" "/usr/sbin/apache2" "/usr/sbin/apache2ctl" "/usr/sbin/apachectl")');
			array_push($ActionArray, '		[ ! -d $DirStorage/$Service/ ] && mkdir -p $DirStorage/$Service/');
			array_push($ActionArray, '		for PathApache in ${PathApacheArray[*]}; do');
			array_push($ActionArray, '			if [ -d $PathApache ]; then');
			array_push($ActionArray, '				local PathFolder=$(basename $(dirname $PathApache))');
			array_push($ActionArray, '				[ ! -d $DirStorage/$Service/$PathFolder ] && mkdir -p $DirStorage/$Service/$PathFolder');
			array_push($ActionArray, '				cp -rf $PathApache $DirStorage/$Service/$PathFolder');
			array_push($ActionArray, '			elif [ -f $PathApache ]; then');
			array_push($ActionArray, '				[ ! -d $DirStorage/$Service/sbin/ ] && mkdir -p $DirStorage/$Service/sbin/');
			array_push($ActionArray, '				cp -rf $PathApache $DirStorage/$Service/sbin/');
			array_push($ActionArray, '			else');
			array_push($ActionArray, '				echo "No se reconoce el fichero " $PathApache');
			array_push($ActionArray, '			fi');
			array_push($ActionArray, '		done');
			array_push($ActionArray, '		echo -e "\n\e[0;32mLa copia de seguridad de Apache se ha realizado con éxito.\e[0;37m\n"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		ShowErrors apache2 "El servicio no existe"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function BackupMySQL(){');
			array_push($ActionArray, '	Service="mysql"');
			array_push($ActionArray, '	if [ `VerifyService mysql` == "Well" ]; then');
			array_push($ActionArray, '		PathMySQLArray=("/usr/lib/mysql/" "/etc/mysql" "/usr/share/mysql")');
			array_push($ActionArray, '		[ ! -d $DirStorage/$Service/ ] && mkdir -p $DirStorage/$Service/');
			array_push($ActionArray, '		for PathMySQL in ${PathMySQLArray[*]}; do');
			array_push($ActionArray, '			if [ -d $PathMySQL ]; then');
			array_push($ActionArray, '				local PathFolder=$(basename $(dirname $PathMySQL))');
			array_push($ActionArray, '				mkdir $DirStorage/$Service/$PathFolder');
			array_push($ActionArray, '				cp -rf $PathMySQL $DirStorage/$Service/$PathFolder');
			array_push($ActionArray, '			fi');
			array_push($ActionArray, '		done');
			array_push($ActionArray, '		ArrayFilesMySQL=($(ls -d /usr/bin/mysql*))');
			array_push($ActionArray, '		for PathFileMySQL in ${ArrayFilesMySQL[*]}; do');
			array_push($ActionArray, '			[ ! -d $DirStorage/$Service/bin/ ] && mkdir -p $DirStorage/$Service/bin/');
			array_push($ActionArray, '			cp -rf $PathFileMySQL $DirStorage/$Service/bin/');
			array_push($ActionArray, '		done');
			array_push($ActionArray, '		echo -e "\n\e[0;32mLa copia de seguridad de MySQL se ha realizado con éxito.\e[0;37m\n"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		ShowErrors mysql "El servicio no existe"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'date_dir=$(date +%d-%b-%Y)');
			array_push($ActionArray, 'date_file=$(date +%d-%m-%Y)');
			array_push($ActionArray, 'hour=$(date +%H-%M)');
			array_push($ActionArray, 'dhcp="dhcp"');
			array_push($ActionArray, 'dns="dns"');
			array_push($ActionArray, 'dirDHCP=("/etc/dhcp/"');
			array_push($ActionArray, '	"/usr/sbin/dhcpd"');
			array_push($ActionArray, '	"/etc/init.d/isc-dhcp-server"');
			array_push($ActionArray, ')');
			array_push($ActionArray, 'dirDNS=("/etc/bind/"');
			array_push($ActionArray, '	"/usr/bin/bind9-config"');
			array_push($ActionArray, '	"/etc/init.d/bind9"');
			array_push($ActionArray, ')');
			array_push($ActionArray, 'function backupDHCP() {');
			array_push($ActionArray, '	if [[ `VerifyService dhcpd` == "Well" ]]; then');
			array_push($ActionArray, '		if [[ ! -d /Backups ]]; then');
			array_push($ActionArray, '			mkdir /Backups');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		chmod -R 777 /Backups/');
			array_push($ActionArray, '		if [[ ! -d /Backups/$date_dir ]]; then');
			array_push($ActionArray, '			mkdir /Backups/$date_dir');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		if [[ ! -d /Backups/$date_dir/$dhcp ]]; then');
			array_push($ActionArray, '			mkdir /Backups/$date_dir/$dhcp');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		for dir_remoto in ${dirDHCP[*]}; do');
			array_push($ActionArray, '			cp -rf $dir_remoto /Backups/$date_dir/$dhcp/');
			array_push($ActionArray, '		done');
			array_push($ActionArray, '		mv /Backups/$date_dir/$dhcp $DirStorage');
			array_push($ActionArray, '		if [[ $? -eq 0 ]]; then');
			array_push($ActionArray, '			echo -e "\n\e[0;32mBacKUP del servicio DHCP realizado con éxito!"');
			array_push($ActionArray, '			echo -e "\e[0;37m"');
			array_push($ActionArray, '		else');
			array_push($ActionArray, '			echo -e "\n\e[0;31mOcurrio un error durante el BacKUP del servicio DHCP\n"');
			array_push($ActionArray, '			echo -e "\e[0;37m"');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		ShowErrors isc-dhcp-server "El servicio no existe"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function backupDNS() {');
			array_push($ActionArray, '	if [[ `VerifyService bind` == "Well" ]]; then');
			array_push($ActionArray, '		if [[ ! -d /Backups ]]; then');
			array_push($ActionArray, '			mkdir /Backups');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		chmod -R 777 /Backups/');
			array_push($ActionArray, '		if [[ ! -d /Backups/$date_dir ]]; then');
			array_push($ActionArray, '			mkdir /Backups/$date_dir');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		if [[ ! -d /Backups/$date_dir/$dns ]]; then');
			array_push($ActionArray, '			mkdir /Backups/$date_dir/$dns');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '		for dir_remoto in ${dirDNS[*]}; do');
			array_push($ActionArray, '			cp -rf $dir_remoto /Backups/$date_dir/$dns/');
			array_push($ActionArray, '		done');
			array_push($ActionArray, '		cp -rf /etc/default/bind9 /Backups/$date_dir/$dns/bind9-default');
			array_push($ActionArray, '		mv /Backups/$date_dir/$dns $DirStorage');
			array_push($ActionArray, '		if [[ $? -eq 0 ]]; then');
			array_push($ActionArray, '			echo -e "\n\e[0;32mBacKUP del servicio DNS realizado con éxito!"');
			array_push($ActionArray, '			echo -e "\e[0;37m"');
			array_push($ActionArray, '		else');
			array_push($ActionArray, '			echo -e "\n\e[0;31mOcurrio un error durante el BacKUP del servicio DNS\n"');
			array_push($ActionArray, '			echo -e "\e[0;37m"');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		ShowErrors bind9 "El servicio no existe"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function CompressFiles(){');
			array_push($ActionArray, '	if [ -d $DirStorage ]; then');
			array_push($ActionArray, '		cd $DirStorage');
			array_push($ActionArray, '		tar -czf $DirStorage.tar.gz *');
			array_push($ActionArray, '		rm -rf ../$DirCompact/');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'function ShowErrors(){');
			array_push($ActionArray, '	echo -e "+ Script en ejecución:\e[0;31m" $0 "\e[0;37m| Servicio:\e[0;31m" ${1} "\e[0;37m"');
			array_push($ActionArray, '	echo -e "+ Mensaje de Error:\e[0;31m" ${2} "\e[0;37m"');
			array_push($ActionArray, '}');
			array_push($ActionArray, 'if [ $# == 0 ]; then');
			array_push($ActionArray, '	echo "Por favor, pase los parámetros necesarios. [IP][-Services ...]"');
			array_push($ActionArray, 'else');
			array_push($ActionArray, '	CreateDirs');
			array_push($ActionArray, '	LA=$@');
			array_push($ActionArray, '	ListArguments=(${LA// / })');
			array_push($ActionArray, 'fi');
			array_push($ActionArray, 'CONTADOR=0');
			array_push($ActionArray, 'while [  $CONTADOR -lt $# ]; do');
			array_push($ActionArray, '	for Dir in $*; do');
			array_push($ActionArray, '		if [[ $(echo $Dir | egrep "^[-data:]*") ]]; then');
			array_push($ActionArray, '			data=$Dir');
			array_push($ActionArray, '		fi');
			array_push($ActionArray, '	done');
			array_push($ActionArray, '	if [ $# == 0 ]; then');
			array_push($ActionArray, '		BackupApache');
			array_push($ActionArray, '		BackupMySQL');
			array_push($ActionArray, '		backupDHCP');
			array_push($ActionArray, '		backupDNS');				
			array_push($ActionArray, '	elif [ $# -gt 0 ]; then');
			array_push($ActionArray, '		case ${ListArguments[$CONTADOR]} in');
			array_push($ActionArray, '			"-apache")');
			array_push($ActionArray, '				BackupApache');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '			"-mysql")');
			array_push($ActionArray, '				BackupMySQL');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '			"-dhcp")');
			array_push($ActionArray, '				backupDHCP');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '			"-dns")');
			array_push($ActionArray, '				backupDNS');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '			$data)');
			array_push($ActionArray, '				echo "Pendiente llamar funcion BackupData"');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '			*)');
			array_push($ActionArray, '				echo "El parámetro: "${ListArguments[$CONTADOR]} "es desconocido"');
			array_push($ActionArray, '			;;');
			array_push($ActionArray, '		esac');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, '	let CONTADOR=CONTADOR+1');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'if [[ $CONTADOR != 0 ]]; then');
			array_push($ActionArray, '	CompressFiles');
			array_push($ActionArray, '	scp -C -r /Backups/* network@192.168.100.10:/Backups');
			array_push($ActionArray, 'fi');	
			
			// if ($this->recvFile("/Backups")){
			// 	echo "Enviado";
			// } else {
			// 	echo "No ha sido enviado";
			// }
			
			$RL[] = $this->remote_path.$filename." ".$arguments;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
				// return "Resultado";
			return getErrors();
		}

		public function getMemoryState(){
			$filename = "getMemoryState.sh";
			$ActionArray[] = "MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},${MEMORIA[3]},${MEMORIA[4]},${MEMORIA[5]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getDiskUsage(){
			$filename = "getDiskUsage.sh";
			$ActionArray[] = "DISCO=($(df -PH | grep sda | cut -d '/' -f3))";
			array_push($ActionArray, 'echo "${DISCO[1]},${DISCO[2]},${DISCO[3]},${DISCO[4]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getNetworkInterfaces(){
			$filename = "getNetworkInterfaces.sh";
			$ActionArray[] = "INTERFACES=($(ifconfig -a -s | awk {'print $1'}))";
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, 'NUM_INTER=${#INTERFACES[*]}');
			array_push($ActionArray, 'for (( i = 1; i < $NUM_INTER ; i++ )); do');
			array_push($ActionArray, '	DIRECCION_IP=$(ifconfig ${INTERFACES[$i]} | grep "inet " | cut -d " " -f10)');
			array_push($ActionArray, '	if [[ $DIRECCION_IP != "" ]]; then');
			array_push($ActionArray, '		echo "${INTERFACES[$i]},$DIRECCION_IP,"');
			array_push($ActionArray, "	else");
			array_push($ActionArray, '		echo "${INTERFACES[$i]},No tiene ip asignada"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getOpenPorts(){
			$filename = "getOpenPorts.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "PORT_TCP=($(netstat -pltona | grep 'tcp ' | awk {'print $4 ,$1'} | cut -d ':' -f2))");
			array_push($ActionArray, "PORT_TCP6=($(netstat -pltona | grep 'tcp6' | awk {'print $4 ,$1'} | cut -d ':' -f4))");
			array_push($ActionArray, 'echo "${PORT_TCP[*]} ${PORT_TCP6[*]},"');
			array_push($ActionArray, "PORT_UDP=($(netstat -pluona | grep 'udp ' | awk {'print $4 ,$1'} | cut -d ':' -f2))");
			array_push($ActionArray, "PORT_UDP6=($(netstat -pluona | grep 'udp ' | awk {'print $4 ,$1'} | cut -d ':' -f4))");
			array_push($ActionArray, 'echo "${PORT_UDP[*]} ${PORT_UDP6[*]}"');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getNetworkConnections(){
			$filename = "getNetworkConnections.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "PROTO=$(netstat -putona | grep -e tcp -e udp | awk {'print $1'})");
			array_push($ActionArray, "DIR_LOCAL=$(netstat -putona | grep -e tcp -e udp | awk {'print $4'})");
			array_push($ActionArray, "DIR_REMOTA=$(netstat -putona | grep -e tcp -e udp | awk {'print $5'})");
			array_push($ActionArray, "ESTADO=$(netstat -putona | grep -e tcp -e udp | awk {'print $6'})");
			array_push($ActionArray, "TEMP1=$(netstat -putona | grep -e tcp -e udp | awk {'print $7'})");
			array_push($ActionArray, 'echo "${PROTO[*]} | "');
			array_push($ActionArray, 'echo "${DIR_LOCAL[*]} | "');
			array_push($ActionArray, 'echo "${DIR_REMOTA[*]} | "');
			array_push($ActionArray, 'echo "${ESTADO[*]} | "');
			array_push($ActionArray, 'echo "${TEMP1[*]} | "');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getUsersConnected(){
			$filename = "getUsersConnected.sh";
			$ActionArray[] = "USUARIOS=($(who | cut -d ' ' -f1))";
			array_push($ActionArray, 'for i in ${USUARIOS[*]}; do');
			array_push($ActionArray, '	echo "$i ,"');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getDHCPShowAssignIP(){
			$filename = "getDHCPShowAssignIP.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "MES=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $1'})");
			array_push($ActionArray, "DIA=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $2'})");
			array_push($ActionArray, "HORA=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $3'})");
			array_push($ActionArray, "IP=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $8'})");
			array_push($ActionArray, "MAC=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $10'})");
			array_push($ActionArray, "INTERFAZ=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print \$NF'})");
			array_push($ActionArray, 'echo "${MES[*]} | "');
			array_push($ActionArray, 'echo "${DIA[*]} | "');
			array_push($ActionArray, 'echo "${HORA[*]} | "');
			array_push($ActionArray, 'echo "${IP[*]} | "');
			array_push($ActionArray, 'echo "${MAC[*]} | "');
			array_push($ActionArray, 'echo "${INTERFAZ[*]} | "');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getDNSFileZones(){
			$filename = "getDNSFileZones.sh";
			$ActionArray[] = "ZONAS=($(cat /etc/bind/named.conf.local | grep 'file' | awk {'print $2'} | tr -d '\";'))";
			array_push($ActionArray, 'CANT_ZONAS=${#ZONAS[*]}');
			array_push($ActionArray, 'for (( i = 0; i < $CANT_ZONAS; i++ )); do');
			array_push($ActionArray, '	DOMINIO=$(cat ${ZONAS[$i]} | grep "SOA" | awk {"print $4"} | sed "s/.$//g")');
			array_push($ActionArray, '	TRADUC=$(cat ${ZONAS[$i]} | grep -e "IN" | tail -n1 | awk "! /$DOMINIO/ {print $1}")');
			array_push($ActionArray, '	IP=$(cat ${ZONAS[$i]} | grep "IN" | tail -n1 | awk "! /$DOMINIO/ {print $4}")');
			array_push($ActionArray, '	echo " ${ZONAS[$i]},$DOMINIO,${TRADUC[*]}.$DOMINIO,${IP[*]}"');
			array_push($ActionArray, "done");
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getHTTPVirtualHost(){
			$filename = "getHTTPVirtualHost.sh";
			$ActionArray[] = "SITIOS=$(ls /etc/apache2/sites-available/)";
			array_push($ActionArray, 'for i in ${SITIOS[*]}; do');
			array_push($ActionArray, '	NAME_SERVER=$(cat /etc/apache2/sites-available/$i | grep "ServerName" | cut -d " " -f2 | tail -n1)');
			array_push($ActionArray, '	SITE_ENABLE=$(ls /etc/apache2/sites-enabled/ | grep $i)');
			array_push($ActionArray, '	if [[ $SITE_ENABLE == "" && $NAME_SERVER == "" ]]; then');
			array_push($ActionArray, '		echo "$i,No identificado,No habilitado"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		echo "$i,$NAME_SERVER,Habilitado"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getNetworkIPLocal(){
			$IP 		= shell_exec('ip route show | awk {"print $NF"}');
			$ArrayIP 	= explode("metric ", $IP);
			$ArrayFinal = array();
			for ($i=0; $i < count($ArrayIP); $i++){
				$ArrayIPTwo = explode(" dev ", $ArrayIP[$i]); 
				for ($j=0; $j < count($ArrayIPTwo); $j++)
					if (strpos($ArrayIPTwo[$j], 'static') != true && strpos($ArrayIPTwo[$j], 'link src') != true && strpos($ArrayIPTwo[$j], 'via') != true)	
					  	array_push($ArrayFinal, trim(substr($ArrayIPTwo[$j], 4)));
			}
			return $ArrayFinal;
		}

		public function getNmapTrackingIP($RangeIPAddress){
			if (is_array($RangeIPAddress)){
				for ($i = 0; $i < count($RangeIPAddress); $i++){
					$val = shell_exec("nmap -sP ".$RangeIPAddress[$i]);
					$ArrayContent 	= explode("Host is up", $val); 
					$ArrayData 		= array();
					for ($i=0; $i < count($ArrayContent); $i++) { 
						$ArrayContentTwo = explode("Nmap scan report for ", $ArrayContent[$i]); 
						for ($j=0; $j < count($ArrayContentTwo); $j++) 
							if (filter_var(trim($ArrayContentTwo[$j]), FILTER_VALIDATE_IP))
							    array_push($ArrayData, $ArrayContentTwo[$j]);
							
					}
				}
				return $ArrayData; 
			} else if (is_string($RangeIPAddress)) {
				$val = shell_exec("nmap -sP ".$RangeIPAddress);
				$ArrayContent 	= explode("Host is up", $val); 
				$ArrayData 		= array();
				for ($i=0; $i < count($ArrayContent); $i++) { 
					$ArrayContentTwo = explode("Nmap scan report for ", $ArrayContent[$i]); 
					for ($j=0; $j < count($ArrayContentTwo); $j++)
						if (filter_var(trim($ArrayContentTwo[$j]), FILTER_VALIDATE_IP))
						    array_push($ArrayData, $ArrayContentTwo[$j]);
						
				}
				return $ArrayData; 
			}
		}
		
		public function getErrors(){
			return implode("<br/>", $this->errors);
		}

		public function testing(){
			return "Okay";
		}

		public function getIPLocalCurrent(){
			return shell_exec("ip route show default | awk '/default/ {print $3}'");
		}

		public function getIPLocal(){
			return trim(shell_exec("ip route | sed '/default/ d' | cut -d ' ' -f1"));
		}

		public function FinalConnect($ip_host, $username, $password){
			if (!function_exists("ssh2_connect")) {
        		array_push($this->errors, "La función ssh2_connect no existe");
			}

        	if(!($this->connect = ssh2_connect($ip_host, 22))){
				$this->ip_host = $ip_host;
        		array_push($this->errors, "No hay conexión con al dirección IP: " . $ip_host);
		    } else {
		        if(!ssh2_auth_password($this->connect, $username, $password)) {
        			array_push($this->errors, "Autenticación invalida");
		        } else {
					$this->ip_host 		= $ip_host;
					$this->username 	= $username;
					$this->password 	= $password;
					$this->remote_path 	= "/home/".$username."/";
		        }
		    }

		    return true;
		}

		public function Tracking(){

			$IPLocal = explode("\n", $this->getIPLocal());
			
			for ($i = 0; $i < sizeof($IPLocal); $i++){
				// $ArrayTotal[$i] = trim($IPLocal[$i]);

				$Info = explode("\n", shell_exec("nmap ".$IPLocal[$i]." -n -sP | grep report | awk '{print $5}'"));
				$ArrayNetwork[$i] = trim($IPLocal[$i]);

				$RL[] = "cat /proc/sys/net/ipv4/ip_forward";
				
				for ($j = 0; $j < sizeof($Info)-1; $j++){
					$ArrayHosts[$i][$j] = trim($Info[$j]);

					$this->FinalConnect($ArrayHosts[$i][$j], "network", "123");

					$ip_forward = $this->RunLines(implode("\n", $RL));

					if ($ip_forward > 0){
						echo "IP: ".$ArrayHosts[$i][$j]." => ".$ip_forward."(Enrutador)<br/>";
					} else {
						echo "IP: ".$ArrayHosts[$i][$j]." => ".$ip_forward."(Host)<br/>";
					}
					

				}
			}

			return array ($ArrayHosts, $ArrayNetwork);
		}

	}
	// echo (new ConnectSSH("192.168.100.2", "network", "123"))->getDHCPShowAssignIP();
?>