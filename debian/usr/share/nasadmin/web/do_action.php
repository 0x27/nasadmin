<?php
if (isset($_GET['action'])) {
  switch ($_GET['action']) {

    case "rescan": 
      echo "rescanning...\n";
      shell_exec("/usr/share/nasadmin/scripts/storage/refreshpart");
      echo "rescan complete\n";
      break;

    default:
      return 1;
  }
}

?>
