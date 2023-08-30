<?php
// error_reporting(0); //(E_ALL & ~E_NOTICE);
include_once("./connect.php");

// $conn2 = oci_connect('KITPMSAPP','kitpmsapp','(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=10.10.8.111)(PORT=1521))(CONNECT_DATA=(SID=KITPROD)))');
// if (!$conn2) {
	// $e = oci_error();
	// trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
// }

include ("phpmailer/PHPMailerAutoload.php");
//include_once("gap.php");
//include ("growth.php");
$update = 42;
$testmode  = false; // jika true, hanya mengirim ke fatah dan heru
$sending = true; //jika true, maka akan mengirim email

if($testmode){
	echo "test mode on<br>";
}

error_reporting(E_ALL);
 $backupdmpa = backupdmp();
 $backupdmp = $backupdmpa[0];
 $diskspace = $backupdmpa[1];
 $backupresult = backupresult($conn);
 $checklistBackup = checklistBackup($conn);
 $diskspacecomm = diskspacecomm($conn);
 $tspace = tspace($conn);
 $ifreport = ifreport($conn);
 $getexecovw = getexecovw($conn);
 $topsql = topsql($conn);
 $aplystandby = aplystandby($conn);
 // $aplystandbynew = aplystandbynew($conn1);
 $dbagrowth = dbagrowth($conn);
 //$backup_bi = backup_bi();

 //$body = date("Y.m.d h:i:s");
 $body = "<table border='1' width='100%'><tr width='200' halign='center'><td rowspan ='2'><img src='cid:KS-Bangkityuk' ></td><td><b>MESFLAT DAILY REPORT</b> v".$update."</td></tr><tr><td>Periode : ".date("d M Y",strtotime("-1 days"))."</td></tr></table>";
 $body .= '<b>'.welcome().' </b> <br>Semoga selalu semangat dalam bekerja dan berikhtiar  <br>ini adalah email otomatis MESFLAT daily report <br>';
 //$body .= 'untuk periode <b>'.date("d M Y",strtotime("-1 days")).'</>  <br>';
 $body .= "Laporan hari ini sebagai berikut: <br>";
 // $body .= '<br>';
 // $body .= "<b>A. Backup Database</b><br>";
 // $body .= '<br>';
 // $body .= "Status Database Backup<br>";
 // $body .= $backupdmp;
 $body .= '<br><br>';
 $body .= "<b>A. Backup Database</b></br>";
 $body .= '<br>';
 $body .= "Status Database Backup<br><br>";
 $body .= $backupresult;
 $body .= '<br><br>';
 $body .= "<b>B. Checklist Backup VM DBProd Veeam</b><br>";
 $body .= '<br>';
 $body .= $checklistBackup;
 $body .= '<br><br>';
 $body .= "<b>C. Standby server Archive log</b><br>";
 $body .= '<br>';
 $body .= $aplystandby;
 $body .= '<br>';
 // $body .= $aplystandbynew;
 $body .= '<br>';
 $body .= "<b>D. Table Space</b><br>";
 $body .= '<br>';
 $body .= $tspace;
 $body .= '<br>';
 $body .= '<b>E. Performance Detail</b><br>';
 $body .= $getexecovw;
 $body .= '<br>';
 $body .= "<b>F. Disk Space Primary DB Server </b><br>";
 $body .= $diskspace;
 $body .= '<br>';
 $body .= "<b>G. Disk Space Comm Server </b><br>";
 $body .= $diskspacecomm;
 $body .= '<br><br>';
 $body .= "<b>H. Growth</b><br><br>";
 $body .= $dbagrowth;
 $body .= '<br>';
 $body .= "<b>I. Interface Report</b><br><br>";
 $body .= $ifreport;
 $body .= '<br><br>';
 $body .= "<b>J. Top SQL</b><br><br> Highest SQL with memory usage";
 $body .= $topsql;
 $body .= '<br><br>';
 //$body .= "<b>J. Backup BI & O2C Database Postgresql</b><br><br>";
 //$body .= $backup_bi;
 

 $body .= "<br><br><center> terimakasih <br>	<br>MESFLAT SYSDBA-INTERFACE Team<br>";
 $body .= '<i>APPLICATION CODE : MFDAILYREPORT Beta Version update '.$update."</i></center>";

 //echo $body;

	$mail = new PHPMailer;

		//$mail->SMTPDebug = 1;
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		//$mail->Host = "ks-clg-eht01v.corp.krakatausteel.com";
		//$mail->Host = "10.10.9.42" //Server 42 bermasalah;
		$mail->Host = "10.10.9.43";

		$mail->Port = 25;
		//$mail->SMTPAuth = true;
		//Provide username and password
		//$mail->Username = "mesflat@krakatausteel.com";
		//$mail->Password = "beitis1";
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "tls";

		//From email address and name
		$mail->From = "mesflat@krakatausteel.com";
		$mail->FromName = " MESFLAT Auto SendMail";

		//To address and name
		//$mail->addAddress("recepient1@example.com", "Recepient Name");
		//$mail->addAddress("fatahfd@gmail.com"); //Recipient name is optional
		//$mail->addAddress("fatah@mitra.krakatausteel.com"); //Recipient name is optional
		
		
		 $mail->addAddress("rosul.haji@krakatausteel.com");
		 $mail->addAddress("arief.nugraha@krakatausteel.com");
		 $mail->addAddress("jokor.azhari@krakatausteel.com");
		 $mail->addAddress("husni.mubarok@krakatausteel.com");		
		
		
		$mail->addAddress("messaging@krakatausteel.com");
		$mail->addAddress("iwan.kurniawan@mitra.krakatausteel.com");
		
		//SYS ADMIN DBA
		$mail->addAddress("iwank21@gmail.com");
		$mail->addAddress("swamtls@gmail.com");
		$mail->addAddress("candra9541@gmail.com");
		
		
		//Address to which recipient will reply
		//$mail->addReplyTo("reply@yourdomain.com", "Reply");


		//CC and BCC
		if ($testmode == false){
		//$mail->addCC("fatah@mitra.krakatausteel.com");

		
		}
		$mail->AddEmbeddedImage("chart/intfsap".date("ymd",strtotime("-1 days")).".png", 'im_intfsap'); //chart interfacekesap
		$mail->AddEmbeddedImage("chart/frmsap".date("ymd",strtotime("-1 days")).".png", 'from_intfsap'); //chart interacedarisap
		$mail->AddEmbeddedImage("chart/growth".date("ymd",strtotime("-1 days")).".png", 'growth'); 
		$mail->AddEmbeddedImage("kit.png", 'kit');
		$mail->AddEmbeddedImage("whijau.png", 'hijau');
		$mail->AddEmbeddedImage("wmerah.png", 'merah');
		$mail->AddEmbeddedImage("wkuning.png", 'kuning');



		//$mail->addBCC("bcc@example.com");

		//Send HTML or Plain Text email
		$mail->isHTML(true);
		$s = "";
		if($testmode) $s = '[TESTING!]';

		$mail->Subject = $s."[Daily Report] MES Flat Daily Report ";//.date("d M y");
		$mail->Body = $body;
		//$mail->AltBody = "This is the plain text version of the email content";
	    if($sending == true){
			if(!$mail->send())
			{
				echo "Mailer Error: " . $mail->ErrorInfo;
			}
			else
			{
				echo "Message has been sent successfully";
			}
		} else {
			echo $body;
		}


function tspace($conn){
$sql = 'select * from ksdba_tablespace_web_vd';
$ret = "<table border = '1' width='100%' style='background-color:white'>";
$ret .= "<tr style='background-color:yellow'><td>TableSpace</td><td>%Used</td><td>Allocated (GB)</td><td>Space Free (GB)</td><td>%Available</td></tr>";
      $vsql  = oci_parse($conn, $sql);
      oci_execute($vsql);
	  $status = "hijau";
	   while($row = oci_fetch_array($vsql))
	  {
		@$ret .= "<tr><td>".$row["TABLESPACE_NAME"]."</td><td>".number_format($row["PCT"],2).'%'."</td><td>".number_format($row["VSIZE"],2)."</td><td>".number_format($row["VFREE"],2)."</td><td>".number_format($row["AVL"],2).'%'."</td></tr>";

		if($row["TABLESPACE_NAME"]=="USERS"){
			if (number_format($row["VFREE"]) < 35){
				$status = "kuning";
			}
			if (number_format($row["VFREE"]) < 15){
				$status = "merah";
			}
		}

	  }

$ret .= "</table><br>";
$ret .= "Yang perlu diperhatikan adalah tablespace <i>USERS</i>, konfigurasi tablespace auto extend  ketika freespace habis (create datafile baru), preconditionnya storage server cukup untuk proses tsb <br>";

$ret .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";

return $ret;
}

function backupresult($conn){
$sql = 'select * from ksdba_backup_result_web_vd';
$ret = "<table border = '1' width='100%' style='background-color:white'>";
$ret .= "<tr style='background-color:yellow'><td>Started</td><td>Backup Type</td><td>Elapsed Time</td><td>Run Min</td><td>Size in MB</td><td>Backup Status</td><td>Control File</td><td>Datafiles</td><td>Arch File</tr>";
      $vsql  = oci_parse($conn, $sql);
      oci_execute($vsql);
	  //$status = "hijau";
	   while($row = oci_fetch_array($vsql))
	  {
		@$ret .= "<tr><td>".$row["START_TIME"]."</td><td>".$row["BACKUP_TYPE"]."</td><td>".$row["TIME_TAKEN_DISPLAY"]."</td><td>".number_format($row["ELAPSED_MIN"],0)."</td><td>".number_format($row["OUTPUT_MBYTES"],2)."</td><td>".$row["BACKUP_STATUS"]."</td><td>".number_format($row["CF"],0)."</td><td>".number_format($row["DFILES"],0)."</td><td>".number_format($row["L"],0)."</td></tr>";

		// if($row["TABLESPACE_NAME"]=="USERS"){
			// if (number_format($row["PCT"]) > 94){
				// $status = "kuning";
			// }
			// if (number_format($row["PCT"]) > 97){
				// $status = "merah";
			// }
		}

	  

$ret .= "</table><br>";
$ret .= "<strong>Note:</strong><br>Data status backup dilampirkan 1 minggu terakhir<br>1. <strong> Incr Lvl 0 </strong> yaitu full backup <br> 2. <strong> Incr Lvl 1 </strong>  yaitu Incremental Backup";

//$ret .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";

return $ret;
}

function dbagrowth($conn){
		$sql = 'select * from perfstat.ksdba_growth_vd'; 
		$ret = "<table border = '1' width='100%' style='background-color:white'>";
		$ret .= "<tr style='background-color:yellow'><td>Tanggal & Waktu</td><td>DB Size (GB)</td><td>Data Usage (GB)</td><td>Free Size (GB)</td></tr>";
		$vsql  = oci_parse($conn, $sql);
      oci_execute($vsql);
	  $c = 0;
	   while($row = oci_fetch_array($vsql))
	   {
		   $ret .= "<tr><td>".$row["SNAP_DATE"]."</td><td>".number_format($row["DB_SIZE_GB"],2)."</td><td>".number_format($row["USED_SPACE_GB"],2)."</td><td>".number_format($row["FREE_SPACE_GB"],2)."</td></tr>";
	   }

	   $ret .= "</table><br>";
	   $ret .= "<strong>Note:</strong><br>1. <b>DB Size</b> is the total of datafiles size allocation including logfiles, undo and Temporary Tablespaces.<br>2. <b>Data Usage</b> is calculated based on data usage excluding undo and temporary tablespaces.<br>";

//$ret .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";

return $ret;
}

function ifreport($conn){
$sql = 'select * from KS_INTF_REPORT_dump';
$ret = "<table border = '1' width='100%' style='background-color:white'>";
$ret .= "<tr style='background-color:yellow'><td>interface Name</td><td>Data count</td></tr>";
      $vsql  = oci_parse($conn, $sql);
      oci_execute($vsql);
	  $c = 0;
	   while($row = oci_fetch_array($vsql))
	  {
		$ret .= "<tr><td>".$row["INTERFACENAME"]."</td><td>".number_format($row["JUMLAH"])."</td></tr>";
		if (substr($row["INTERFACENAME"],0,3)=="BACK"){
			if (number_format($row["JUMLAH"]) > 0){
				$c++;
			}
		}
	  }

$ret .= "</table><br>";
$ret .=  "Jika ada Backlog interface perlu segera dimitigasi <br>";
$ret .= "<img src='cid:im_intfsap'></img>"."<img src='cid:from_intfsap'></img>";
//$ret .= "<img src='cid:from_intfsap'></img>";
	if($c>0){
	$status = "merah";
	} else {
	$status = "hijau";
	}

$ret .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";

return $ret;
}

function getexecovw($conn){
		$head = "";
		$qz = "select * from KSLOGEXEC_allgap_vd";
		$ez  = oci_parse($conn, $qz);
		oci_execute($ez);
		while($roz = oci_fetch_array($ez)){
		($roz["PRCTGAP"] < 100) ? $lb = "cepat" : $lb = "lambat";
		 $head .= "Kecepatan rata-rata proses di MES saat ini <b>".number_format(trim($roz["CURRENTGAP"]))."</b> detik.\nTransaksi (<b>".$roz["PRCTGAP"]."%</b>) Lebih ".$lb.", rata-rata <b>".number_format(trim($roz["ALLEXECGAP"])). "</b> detik pada periode waktu yang sama";
		}


		$q = "select * from KSLOGEXEC_OVERVIEW";
		$ex  = oci_parse($conn, $q);
		oci_execute($ex);
		$head .= "\n\nSetelah kami analisis pada kecepatan produksi, movement  dan inspeksi,";
		$type = "";
		$r = 0;
		$det = "";
		$ret = "";
		while($row = oci_fetch_array($ex)){

			$anlages = str_replace(";  ","\n",$row["ANLAGES"]);
			$anlages = str_replace("*","",$anlages);
			$det .= "\n\n<b>".$row["EXECTYPENAME"]."</b>\nAda ".$row["CN"]." line yang kecepatan prosesnya dibawah rata-rata:\n".$anlages;//.$prc."%";
			$r++;
		}
		if ($r>0){
			$ret .= "".$head." berikut hasil yang didapatkan: \n".$det;
		} else {
			$ret .= "".$head." sepertinya <b>Semua line produksi lancar</b>";
		}
		//$ret .= "\n\n_untuk melihat statistik detail gunakan keyword `performance detail `_";
		//if (strpos(strtolower($msg), "detail"))
		//$ret .= getexeclog($conn);

		return '<pre>'.$ret.'</pre>';

}
//echo getexecovw($conn);
//exit;

/*function getexeclog($conn){
		$q = "select * from KSLOGEXEC_STATANLAGE";
		$ex  = oci_parse($conn, $q);
		oci_execute($ex);
		$ret = "\nBerikut statistik lama waktu proses produksi & inspeksi dibandingkan 1 jam terakhir";
		$type = "";
		while($row = oci_fetch_array($ex)){
			if ($type != $row["EXECTYPENAME"]) $ret .= "\n\n\nProses : <b>".$row["EXECTYPENAME"]."</b>";
			$type = $row["EXECTYPENAME"];
			$prc = round(($row["CURRENTGAP"] / $row["ALLEXECGAP"] ) * 100,2);
			$ret .= "\n".$row["BEREICH"]."  <i>".$row["ANLAGE"]."</i> \nAvg ".number_format($row["ALLEXECGAP"])." detik ; Current ".number_format($row["CURRENTGAP"])." detik ";//.$prc."%";
		}
		return $ret;

}*/


function topsql($conn){
$sql = 'select * from KSTOPSQL2_VD';
$ret = "<table border = '1' width='100%' style='background-color:white'>";
$ret .= "<tr style='background-color:yellow'><td>SQL</td><td>module</td></tr>";
      $vsql  = oci_parse($conn, $sql);
      oci_execute($vsql);
	   while($row = oci_fetch_array($vsql))
	  {
		$ret .= "<tr><td width='80%'>".$row["SQL_FULLTEXT"]."..</td><td>".$row["MODULE"]."</td></tr>";
	  }

$ret .= "</table><br>";

$ret .= "data benchmark ini tidak akan berubah sampai dilakukasn flush SGA<br>";

return $ret;
}

// function aplystandbynew($conn1){
// $sql = 'select max(sequence#) from v$log_history';
	// $vsql = oci_parse($conn1, $sql);
	// oci_execute($vsql);
	// while($row = oci_fetch_array($vsql))
	// {
		// $ret .= "<tr><td width='80%'>".$row["MAX(SEQUENCE#)"]."</td></tr>";
	// }
// return $ret;
// }

function aplystandby($conn){
$path = "\\\\10.10.8.111\job";
$path2 = "\\\\10.10.8.114\job\job_dbstandby";
$path21 = "\\\\10.10.8.114\job\job_dbstandby2";
$path3 = "\\\\10.10.8.111\arch_stbd";
$path4 = "\\\\10.10.8.112\arch_stbd";
$path5 = "\\\\10.10.8.158\kitprod";
$path6 = "\\\\10.10.8.114\job\disk_dbprod";
$user = "oracle";
$user2 = "oracle";
$pass = "oracle";
$pass1 = "0racleDB";
$pass6 = "kitpmscom";
$user6 = "kitpmscom";
$user1 = "administrator";
//$pass3 = "P@ssw0rdmes";

$drive_letter3 = "E";
system("net use ".$drive_letter3.": \"".$path2."\" ".$pass." /user:".$user." /persistent:no>nul 2>&1");

$drive_letter2 = "E";
system("net use ".$drive_letter2.": \"".$path."\" ".$pass." /user:".$user." /persistent:no>nul 2>&1");

$drive_letter4 = "G";
system("net use ".$drive_letter4.": \"".$path4."\" ".$pass." /user:".$user." /persistent:no>nul 2>&1");

//$drive_letter5 = "E";
//system("net use ".$drive_letter5.": \"".$path5."\" ".$pass1." /user:".$user2." /persistent:no>nul 2>&1");

$drive_letter6 = "E";
system("net use ".$drive_letter6.": \"".$path21."\" ".$pass1." /user:".$user2." /persistent:no>nul 2>&1");

$drive_letter6 = "G";
system("net use ".$drive_letter6.": \"".$path6."\" ".$pass6." /user:".$user6." /persistent:no>nul 2>&1");



 // $tfile1 = $drive_letter.":/status1.log";
 // $tfile2 = $drive_letter.":/status2.log";
 // if ( file_exists($tfile1) && ($fp = fopen($tfile1, "rb"))!==false ) {
// } else {
	// return "data tidak dapat di proses<br>";
// }
 // $f1 = fopen($tfile1, "r");
 // $f2 = fopen($tfile2, "r");
 // $boo1 = fgets($f1);
 // $boo2 = fgets($f2);
 // $words1 = explode(';', $boo1);
 // $words2 = explode(';', $boo2);

  // $d1 = date_create($words1[1]);
  // $d2 = date_create($words2[1]);

  // $s1 = strtotime($words1[1]);
  // $s2 = strtotime($words2[1]);

  // $interval  = abs($s2 - $s1);
  // $jam   = round($interval / 60 / 60);

  //$vmprod = date_format($d2,"Y.m.d H:i");

 // $dir = scandir($path);
// $lastFile = null;
// foreach($dir as $i => $d) {
	// if (strpos($d, 'ARC000025') === 0) {
		// $lastFile = $d;

	// }
// }

	$words1 = array();
$words1[0] = 'last_archivelog_primarydb.txt';	//Nama file target archivelog
$words1[1] = file_get_contents($path6. "\last_archivelog_primarydb.txt");	//membuka file target archivelog
$words1[1] = trim(explode("\n", trim($words1[1]))[2]);



$dir = scandir($path6);
$lastFile = null;
foreach($dir as $i => $d) {
	if (strpos($d, 'ARC000000') === 0) {
		$lastFile = $d;

	}
}
$tgl = '2016-01-01 00:00:01';
if (file_exists($path6 .'\\'. $lastFile)) {
	$mtime = (filemtime($path6 . "\last_archivelog_primarydb.txt" . $lastFile));
	$tgl = date('Y-m-d H:i:s', $mtime);
	$archive = array();
	$archive[0] = $lastFile;
	$archive[1] = $tgl;
}

  $v  = "<table width = '100%' border='1'>";
  $v .= "<tr style='background-color:yellow'><td>Server</td><td>Send Archive Log </td><td>MAX(SEQUENCE#)</td></tr> ";
 $v .= "<tr><td>Main Production DB</td><td>".'<strong>'.$words1[0].'</strong>'."</td><td>".'<strong>'.$words1[1].'</strong>'."</td> </tr>";


  // $a = '<br><b>ARCHIVELOG PRODUCTION SERVER</b><BR/>';
  // $a .= '1. LAST ARCHIVELOG : <b>'.$archive[0].'</b>';
  // $a .= '<br />';
  // $a .= '2. LAST DATETIME   : <b>'.$archive[1].'</b>';
  
  $a = '<br><b>ARCHIVELOG PRODUCTION SERVER</b><BR/>';
  $a .= '1. LAST ARCHIVELOG : APPLY';
  $a .= '<br />';
  $a .= '2. LAST DATETIME   : <b>'.$archive[1].'</b>';

  //fclose($f1);

  $a .= '<br /><br>';
  $a .= '<b>ARCHIVELOG STANDBY SERVER</b> <BR />';

  
  $words2 = array();
$words2[0] = 'standby_appliedlog1.txt';
$words2[1] = file_get_contents($path2. "\standby_appliedlog1.txt");
$words2[1] = trim(explode("\n", trim($words2[1]))[2]);

$dir2 = scandir($path2);
$lastFile2 = null;
foreach($dir2 as $x => $f) {
	if (strpos($f, 'ARC000000') === 0) {
		$lastFile2 = $f;

	}
}

$tgl2 = '2016-01-01 00:00:01';
if (file_exists($path2 .'\\'. $lastFile2)) {
	$mtime2 = (filemtime($path2 . "\standby_appliedlog1.txt" . $lastFile2));
	$tgl2 = date('Y-m-d H:i:s', $mtime2);
	$archive1 = array();
	$archive1[0] = $lastFile2;
	$archive1[1] = $tgl2;
}

  $v .= "<tr><td>Standby Production DB</td><td>".'<strong>'.$words2[0].'</strong>'."</td><td>".'<strong>'.$words2[1].'</strong>'."</td> ";

  $a .= '1. LAST ARCHIVELOG : APPLY <b>'.$archive1[0].'</b>';
  $a .= '<br />';
  $a .= '2. LAST DATETIME   : <b>'.$archive1[1].'</b>';
  
  $a .= '<br /><br>';
  $a .= '<b>ARCHIVELOG STANDBY SERVER 2</b> <BR />';

  
  $words3 = array();
$words3[0] = 'standby_appliedlog2.txt';
$words3[1] = file_get_contents($path21. "\standby_appliedlog2.txt");
$words3[1] = trim(explode("\n", trim($words3[1]))[2]);


$dir3 = scandir($path21);
$lastFile3 = null;
foreach($dir3 as $x => $f) {
	if (strpos($f, 'ARC000000') === 0) {
		$lastFile3 = $f;

	}
}

$tgl3 = '2016-01-01 00:00:01';
if (file_exists($path21 .'\\'. $lastFile3)) {
	$mtime3 = (filemtime($path21 . "\standby_appliedlog2.txt" . $lastFile3));
	$tgl3 = date('Y-m-d H:i:s', $mtime3);
	$archive2 = array();
	$archive2[0] = $lastFile3;
	$archive2[1] = $tgl3;
}

  $v .= "<tr><td>Standby Production DB 2</td><td>".'<strong>'.$words3[0].'</strong>'."</td><td>".'<strong>'.$words3[1].'</strong>'."</td> ";

  $a .= '1. LAST ARCHIVELOG : APPLY <b>'.$archive2[0].'</b>';
  $a .= '<br />';
  $a .= '2. LAST DATETIME   : <b>'.$archive2[1].'</b>';



  //fclose($f2);

	// $ret = "<table border = '1' width='100%' style='background-color:white'>";
	// $ret .= "<tr style='background-color:yellow'><td>Apply Status</td></tr>";
	// $ret .= "<tr style='background-color:white'><td>".$a."</td></tr>";
	// $ret .= "</table>";

	// $s1 = strtotime($words1[1]);
	// $s2 = strtotime($words2[1]);


	$n1 = (int)$words1[1];
	$n2 = (int)$words2[1];
	$n3 = (int)$words3[1];
	
	if($n2 == $n3){
		$pengurangan = ($n1 - $n2);
//	}elseif($n2 > $n3){
//		$pengurangan = ($n1 - $n3);	 //sementara diremark karena standby 158 kondisi Open DB
	}else{
		$pengurangan = ($n1 - $n2);  //sementara diremark karena standby 112 kondisi Open DB
		//$pengurangan = ($n1 - $n3);
	}
    $checkpoint   = ($pengurangan);

  $v .= "<tr><td colspan='2'>Gap Waktu sinkronisasi Main DB dan Standby Server<td>"."<strong>".$checkpoint."</strong>"." "."Checkpoint</td></tr> ";
  $v .= "</table>";

  $ret =  $v;
  $ret .=  $a;
  $ret .= "<br><br>Secara periodical (1 jam) archive log dari main production server di sinkronkan  ke standby server. Apabila gap sequence pada standby 2 server dengan main production server jauh itu dikarenakan apply archivelog standby 2 dilakukan per 6 jam untuk mengantisipasi apabila terjadi insiden seperti waktu lalu yang menghilangkan tabel atau data.";
  $ret .= "<tr><td>
		<i>info</i> <br>
		Standby server merupakan server cadangan / mirror server dari Database utama MES Flat <br>
		Apabila terjadi masalah di Database server utama, maka aplikasi akan diarahkan ke standby server <br>
		data di standby server di sinkronkan paling lambat per 1 jam  <br>
		</td></tr></table><tr>";

	// $s1 = strtotime($words1[1]);
	// $s2 = strtotime($words2[2]);

	// $interval  = abs($s2 - $s1);
    // $jam   = round($interval);

	// if ($jam > 0){
	// $ret .= "</p>".whatsup($jam,$conn);
  // }

  $status = "hijau";
if ($checkpoint > 3){
	$status = "kuning";
}
if ($checkpoint > 4){
	$status = "merah";
}
$ret .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";
return $ret;
}

/*function growth(){
$path = "\\\\10.10.8.111\job";
$path2 = "\\\\10.10.8.101\BEdata";
$user = "oracle";
$user2 = "Administrator";
$pass = "oracle";
$pass2 = "password..1";

$drive_letter = "E";
system("net use ".$drive_letter.": \"".$path."\" ".$pass." /user:".$user." /persistent:no>nul 2>&1");

$nae = $path."\hasilgrowth.txt";

 if ( file_exists($nae)) {
	 $content = file_get_contents($nae);
	 $xy = '';
 }
 else{$content = "";}

$status = "hijau";
//$ret = "<br><table border='1' width='100%'><tr><td>Berikut simulasi pertumbuhan ukuran Database dibandingkan dengan ukuran Database tiap bulan <br> <img src='cid:growth' alt='growth file'></img></td></tr></table>";
$ret = "Berikut simulasi pertumbuhan ukuran Database terhitung dengan ukuran Database tiap bulan. ";
// $ret = "<br><table border='1' width='100%'><tr><td>Berikut simulasi pertumbuhan ukuran file backup dibandingkan dengan ketersediaan storage <br> <img src='cid:growth' alt='growth file'></img></td></tr></table>";
$ret .= "<pre> ".$content." </pre>";
//$ret .= "Daftar Growth Database diatas terhitung tiap Bulan, file Growth tersebut terdapat pada  <br>";
$ret .= "<table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."'></img></td></tr></table>";
return $ret;
}*/

function diskspacecomm($conn){

$path3 = "\\\\10.10.8.114\job";
$user3 = "kitpms";
$pass3 = "kitpms";
$drive_letter3 = "C";

system("net use ".$drive_letter3.": \"".$path3."\" ".$pass3." /user:".$user3." /persistent:no>nul 2>&1");
//$location = $drive_letter."/backup_online";
 //$tfile = $drive_letter.":/".$filelog;
  $tsize1 = $path3."\diskspace.txt";
 // $xz = '';
 
 $ketDriveComm = [
	'C:' => 'System OS & PSIMetals Programs',
 ];
 
 if ( file_exists($tsize1)) {
	 $contentz = file_get_contents($tsize1);
	 $contentsz = explode("\n", $contentz);
	 $xz = '';
	
	 
	 foreach($contentsz as $zoo) {
		if(trim($zoo) != '') {
			$zoo = str_replace(" ","_",$zoo);
			$wordz = explode('_',$zoo);
			// print_r($wordz);
			// exit;
			$xz .= "<tr><td>".$wordz[0] . (isset($ketDriveComm[trim($wordz[0])]) ? ' '.$ketDriveComm[trim($wordz[0])] : '') ."</td><td>".$wordz["2"]." ".$wordz["3"]."</td><td>".$wordz["5"]." ".$wordz["6"]."</td></tr>";
				
			//$xz .= "<tr><td>".$wordz[0] . (isset($ketDriveComm[trim($wordz[0])]) ? ' '.$ketDriveComm[trim($wordz[0])] : '') ."</td><td>".$wordz["2"]." ".$wordz["3"]."</td><td>".$wordz["5"]." ".$wordz["6"]."</td></tr>";
		}
	 }
}

 $ret = "<table border = '1' width='100%'><tr  style='background-color:yellow'><td>Drive</td><td>Total</td><td>Free</td></tr><tr>".$xz."</table>";

		//return '<pre>'.$ret.'</pre>';
return $ret;

  }
  
  
function backupdmp(){
try {
//$filelog = "EXDPKITPROD_".date("Y_m_d",strtotime("-1 days")).'.log';
//$path = "\\\\10.10.8.111\backup_online";
$path = "\\\\10.10.8.111\job";
//$path2 = "\\\\10.10.8.101\BEdata";
$path3 = "\\\\10.10.8.114\job\disk_dbprod";
$user = "oracle";
$pass = "oracle";
$user2 = "Administrator";
$pass2 = "password..1";
$drive_letter = "E";
$drive_letter2 = "E";

system("net use ".$drive_letter2.": \"".$path3."\" ".$pass2." /user:".$user2." /persistent:no>nul 2>&1");

//$location = $drive_letter."/backup_online";
 //$tfile = $drive_letter.":/".$filelog;
 $tsize = $path3. '\diskusage.txt';
 $xy = '';
 // if ( file_exists($tfile) && ($fp = fopen($tfile, "rb"))!==false ) {

	 // $fy = fopen($tsize, "r");
	  // while(!feof($fy)){
			// $boo = fgets($fy);
			// $boo = str_replace(" ","_",$boo);
			// $words = explode('_',$boo);

			// $xy .= "<tr><td>".$words[0]."</td><td>".$words["2"]." ".$words["3"]."</td><td>".$words["5"]." ".$words["6"]."</td></tr>";
			// //$words = array_diff($words, array('-', ' '));
			// //$xy .= "".$boo."<br>";
	  // }
	  // fclose($fy);
  // }

 $ketDrive = [
	'/' => '  (Linux OS)',
	'/u01' => '  (Oracle Db Software)',
	'/u02' => '  (Oracle database files)',
	'/u03' => '  (Local backup and scripts)',
	'/u03/' => '  (Local backup and scripts)',
	'/u03/SmbBackupProd' => '  (File Backup Database)',
 ];
 
 
 if ( file_exists($tsize)) {
	 $content = file_get_contents($tsize);
	 $contents = explode("\n", $content);
	 $xy = '';

	 foreach($contents as $boo) {
		if(trim($boo) != '') {
			$boo = str_replace(" ","_",$boo);
			$words = explode('_',$boo);

			$xy .= "<tr><td>".$words[0] . (isset($ketDrive[trim($words[0])]) ? ' '.$ketDrive[trim($words[0])] : '') ."</td><td>".$words["2"]."</td><td>".$words["4"]."</td></tr>";
		}
	 }
 }
 

 

// $dir = scandir($path);
// $lastFile = null;
// foreach($dir as $i => $d) {
	// if (strpos($d, 'USERS0') === 0) {
		// $lastFile = $d;

	// }
// }

// $dir2 = scandir($path2);
// $lastFile2 = null;
// foreach($dir2 as $x => $f) {
	 // if (strpos($f, 'B2D000828') === 0) {
		 // $lastFile2 = $f;

	 // }
 // }

 // $dir3 = scandir($path2);
 // $lastFile3 = null;
 // foreach($dir3 as $j => $k) {
	 // if (strpos($k, 'B2D000831') === 0) {
		 // $lastFile3 = $k;

	// }
// }

// $foo = '';
  
  $tgl = '2016-01-01 00:00:01';

  // if (file_exists($path .'\\'. $lastFile)) {
	// $mtime = (filemtime($path . '\\' . $lastFile));
	// $tgl = date('Y-m-d H:i:s', $mtime);
	// // $mtime2 = (filemtime($path2 . '\\' . $lastFile2));
	// // $tgl2 = date('Y-m-d H:i:s', $mtime2);
	// // $mtime3 = (filemtime($path2 . '\\' . $lastFile3));
	// // $tgl3 = date('Y-m-d H:i:s', $mtime3);
	// $foo .= 'Full Backup online succeded on: '.'<strong>'. $tgl.'</strong>'.'<br>'.'with filename & type:  ';
	// $foo .= /*$path .'\\'.*/ '<strong>'.$lastFile.'</strong>'.'<br><br>';
	// // $foo .= 'Incremental Backup succeded on: '.'<strong>'. $tgl2.'</strong>'.'<br>'.'with filename & type: ';
	// // $foo .= /*$path .'\\'.*/ '<strong>'.$lastFile2.'</strong>'.'<br><br>';
	// // $foo .= 'Archive Log Backup succeded on: '.'<strong>'. $tgl3.'</strong>'.'<br>'.'with filename & type: ';
	// // $foo .= /*$path .'\\'.*/ '<strong>'.$lastFile3.'</strong>'.'<br><br>';

	// }


// if ( file_exists($tfile) && ($fp = fopen($tfile, "rb"))!==false ) {
// $fp = fopen($tfile, "r");
// $data = "";
// $mm = array();
// $i = 0;
// while(!feof($fp))
// {

	// $mm[$i] = fgets($fp, 4096);
	// $i++;
// }
// }
// $jml =  count($mm);
 // $foo = "";
  // $foo .= $mm[9]."<br>";
  // $foo .= $mm[$jml -4]."<br>";
  // $foo .= $mm[$jml -3]."<br>";
  // $foo .= $mm[$jml -2]."<br>";
  // $foo .= $mm[$jml -1]."<br>";
  
 $yeon = $path. '\rman_kitprod_backup_result.txt';
 
 if ( file_exists($yeon)) {
	 $content2 = file_get_contents($yeon);
	$xz = '';
 }
 else{$content2 = "";}
 
  //$ret[0] = "Berikut Status Backup Database Oracle MESFLAT PRODUCT: <br> ";
  $ret[0] = "<table border = '1' width='100%' style='background-color:white'><tr><td>"."<pre> ".$content2." </pre>"."</td></tr></table>";
  $ret[0] .= "<br> Full Backup minggu ini dengan Backup Type: <br> 1. <strong> Incr Lvl 0 </strong> yaitu full backup <br> 2. <strong> Incr Lvl 1 </strong>  yaitu Incremental Backup";
  //$ret [0] = "<pre> ".$content2." </pre>";

  //$ret[0] = "<table border = '1' width='100%' style='background-color:white'><tr><td>".$foo."</td></tr></table>";
  //$ret[1] = "<br> DB Server disk space";
  $ret[1] = "<table border = '1' width='100%'><tr  style='background-color:yellow'><td>Mount</td><td>Total</td><td>Free</td></tr>".$xy."</table>";
 
	//$ret[1] .= "ket:<br>C: Drive System OS Windows Server<br>E: Drive File System oracle, High Priority<br>F: Drive Control & Trace file Oracle<br>G: Drive Fast Copy & Total CMD<br>H: Drive Backup Temporary<br>K: Drive untuk Backup & Archive Log<br>";

  // $err = 0; $completed = 0;
  // if (strpos($ret[0], 'error') !== false) {
    // $err = 1;
  // }
  // if (strpos($ret[0], 'completed') !== false) {
    // $completed = 1;
  // }
  // $status ="merah";
  // if (($err == 1) && ($completed == 1)){
	// $status = "kuning";
  // }

  // if (($err == 0) && ($completed == 1)){
	// $status = "hijau";
  // }

  // if (($err == 1) && ($completed == 0)){
	// $status = "hijau";
  // }

	/*
	if (strtotime($tgl) >= time() - (7 * 24 * 60 * 60)) {
		$status = 'hijau';
	} elseif (strtotime($tgl) >= time() - (14 * 24 * 60 * 60)) {
		$status = 'kuning';
	} else {
		$status = 'merah';
	}


	$ret[3] .= "<br><table border='1'><tr><td>Resume Status</td><td><img src='cid:".$status."' alt='".$status."' /></td></tr></table>";
	*/
	
  return $ret;
  } catch (Exception $e) {
    return 'Caught exception: '.  $e->getMessage(). "\n";
	}
}

function checklistBackup($conn){

$path3 = "\\\\10.10.8.51\job\checklistBackup";
$user3 = "administrator";
$pass3 = "P@ssw0rdmes";
$drive_letter3 = "E";

system("net use ".$drive_letter3.": \"".$path3."\" ".$pass3." /user:".$user3." /persistent:no>nul 2>&1");
//$location = $drive_letter."/backup_online";
 //$tfile = $drive_letter.":/".$filelog;
  $tsize1 = $path3. '\checklistBackup.txt';
  $tsize2 = $path3. '\checklistBackupPreprod.txt';
  //echo $tsize1;
 // $xz = '';
  //$ketFileBackups = [
	//'Success',
	//];

 //$ketDriveComm = [
		//'C:' => 'System OS & PSIMetals Programs',
	 //];
	
	 if ( file_exists($tsize1)) {
		$contentz = file_get_contents($tsize1);
		$contentsz = explode("\n", $contentz);
		$xz = '';
	
	 //$contents = file_get_contents($tsize1);
		 //echo $contents;
		foreach ($contentsz as $zoo){
			if(trim($zoo) != ''){
			$zoo = str_replace(" ","%",$zoo);
			//$zoo1 = str_replace("%%","%",$zoo);
			//echo $zoo;
			$wordz = explode('%',$zoo);
			//print_r($wordz);
			//exit;
			$xz .= "<tr><td>".$wordz["0"]."</td><td>".$wordz["1"]." ".$wordz["2"]."</td><td>".$wordz["3"]."&nbsp".$wordz["4"]."&nbsp".$wordz["5"]."&nbsp".$wordz["6"]."</td></tr>";
			
			//print_r ($xz);
			//exit;
			}
		}
	}

	if ( file_exists($tsize2)) {
		$contentz1 = file_get_contents($tsize2);
		$contentsz1 = explode("\n", $contentz1);
		$xz1 = '';
        //exit;
	 
		foreach ($contentsz1 as $foo){
			if(trim($foo) != ''){
			$foo = str_replace(" ","%",$foo);
			//$zoo1 = str_replace("%%","%",$zoo);
			//echo $zoo;
			$wordz1 = explode('%',$foo);
			//print_r($wordz);
			//exit;
			$xz1 .= "<tr><td>".$wordz1["0"]. $wordz1[1] . "</td><td>".$wordz1["2"]." ".$wordz1["3"]."</td><td>".$wordz1["5"]."&nbsp".$wordz1["6"]."&nbsp". $wordz1["7"]."&nbsp". $wordz1["8"]."</td></tr>";
			
			//print_r ($xz);
			//exit;
			}
		}
	}
	
$ret = "<table border = '1' width='100%'><tr  style='background-color:#04AA6D'><td>Checklist Success Backups</td><td>Size in GB</td><td>Date</td></tr><tr>".$xz."</table>";
$ret .= "<br> Server mesflat Database Production backup Veeam on Disk: <br> 1. <strong> Files .vbk </strong> adalah Job Synthetic full backup <br> 2. <strong> Files .vib </strong>  adalah Incremental Backup <br> 3. Backup Job ini disimpan selama 2 minggu, yang dimana setiap hari minggu dilakukan Full Backup. <br> 4. Ketika file-file ini sukses terbackup pada disk, dilanjutkan otomatis untuk backup kedalam tape yang sudah ditentukan <br>";
$ret .= "<br> <b>Checklist Backup VM Preproduction Server</b><br>";
$ret .= "<br> <table border = '1' width='100%'><tr  style='background-color:#04AA6D'><td>Checklist Success Backups Server Preprod mesfp</td><td>Size in GB</td><td>Date</td></tr><tr>".$xz1."</table>";
$ret .= "<br> Server mesflat Preproduction Veeam on Disk Including: 
<br> 1. <strong> Foglight Server </strong>
<br> 2. <strong> Comm Server Prod, QA, Dev </strong>
<br> 3. <strong> Zebra Server , Web server mesflat, SVN & Jenkins Server </strong> 
<br> 4. <strong> Vcenter 8.40, SAP Router, Remote Server";

return $ret;

}

 function welcome(){

   if(date("H") < 12){

     return "Selamat Pagi!";

   }elseif(date("H") > 11 && date("H") < 18){

     return "Selamat Siang!";

   }elseif(date("H") > 17){

     return "Selamat Sore!";

   }

}
?>
