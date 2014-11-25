<?php

$page_id=5;
include 'header.php';

$os_disk=trim(shell_exec('/usr/share/nasadmin/scripts/os/getosdisk'));

function byte_power($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor] . "B";
}

exec('/usr/share/nasadmin/scripts/storage/getfs',$filesystems);

$count=0;
foreach ($filesystems as $fsline) {
  $fs = split(" ", $fsline);
  $_dev=$fs[0];
  $_size=$fs[1];
  $_fs=$fs[2];
  $_uuid=$fs[3];
  $_used="";
  $_mountpoint="[Not mounted]";
  $_free="";
  if (count($fs)>4) {
    $_used=$fs[4];
    $_free=$fs[5];
    $_mountpoint=$fs[6];
  }

  if ($count==0) echo '            <div class="row">'.chr(10);
  echo '             <div class="col-md-6 col-sm-12">'.chr(10);
  echo '              <div class="panel panel-';
  if (strpos($_dev,$os_disk)===0) echo "primary"; else echo "default";
  echo '">'.chr(10);
  echo '               <div class="panel-heading">'.chr(10);
  echo '                <i class="fa fa-folder-open fa-fw"></i> '.$_dev.chr(10);
  echo '               </div>'.chr(10);
  echo '               <div class="panel-body">'.chr(10);
  echo '                <table class="table borderless table-condensed">'.chr(10);
  echo '                 <tr><td><strong>Size</strong></td><td>'.byte_power($_size,0);
    if ($_free!="") echo ' ('.byte_power($_free*1024,1).' free)';
    echo '</td></tr>'.chr(10);
  echo '                 <tr><td><strong>File System</strong><td>'.$_fs.'</td></tr>'.chr(10);
  echo '                 <tr><td><strong>Mountpoint</strong><td>'.$_mountpoint.'</td></tr>'.chr(10);
  echo '                </table>'.chr(10);

  echo '                <div class="progress">'.chr(10);
  echo '                  <div class="progress-bar progress-bar-';
  if (strpos($_dev,$os_disk)===0) echo "primary"; else echo "success";
  echo '" role="progressbar" aria-valuenow="'.$_used.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$_used.'%">'.chr(10);
  echo '                   <span class="sr-only">'.$_used.'% used</span>'.chr(10);
  echo '                  </div>'.chr(10);
  echo '                 </div>'.chr(10);

  echo '               </div>'.chr(10);
  echo '              </div>'.chr(10);
  echo '             </div>'.chr(10);

  $count++;
  if ($count==2) {
    echo '            </div>'.chr(10);
    $count=0;
  }
} 

include 'footer.php';
?>
