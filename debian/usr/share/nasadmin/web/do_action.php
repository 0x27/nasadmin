<?php
$script_dir='/usr/share/nasadmin/scripts/';
if (isset($_GET['action'])) {
  switch ($_GET['action']) {

    case "rescan": 
      echo "rescanning...\n";
      shell_exec("/usr/share/nasadmin/scripts/storage/refreshpart");
      echo "rescan complete\n";
      break;

    case "mount":
      if (isset($_GET['uuid'])) {
        echo shell_exec($script_dir."storage/domount ".$_GET['uuid']); 
      }
      break;

    case "umount":
      if (isset($_GET['uuid'])) {
        echo shell_exec($script_dir."storage/doumount ".$_GET['uuid']); 
      }
      break;

    default:
      return 1;
  }
}

?>
