<?php

$page_id=3;
include 'header.php';

function byte_power($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor] . "iB";
}

$os_disk=shell_exec('/usr/share/nasadmin/scripts/os/getosdisk');

//$out=array();
$result=exec('/usr/share/nasadmin/scripts/storage/getdisks',$out);
$count=0;
foreach ($out as $item) {

  $split_item = split(':',$item);
  $command='/usr/share/nasadmin/scripts/storage/getdiskdetail '.$split_item[0];
  exec($command,$disk_details);


  if ($count==0) echo '            <div class="row">'.chr(10);

  echo '                <div class="col-lg-4 col-md-4 col-xs-12">'.chr(10);
  echo '                    <div class="panel panel-';
  if (trim($split_item[0])==trim($os_disk)) echo "primary"; else echo "default";
  echo '">'.chr(10);
  echo '                        <div class="panel-heading">'.chr(10);

  echo '                            <i class="fa fa-hdd-o fa-fw"></i> '.$split_item[0].chr(10);

  echo '                        </div>'.chr(10);
  echo '                        <div class="panel-body">'.chr(10);

  echo '                            <table class="table-condensed borderless">';

  echo '<tr><td><strong>Size</strong></td><td>'.byte_power($split_item[1],0).'</td></tr>'.chr(10);


  echo '<tr><td><strong>Model</strong></td><td>'.trim($disk_details[0]).'</td></tr>'.chr(10);
  echo '<tr><td><strong>Serial</strong></td><td>'.trim($disk_details[1]).'</td></tr>'.chr(10);
  echo '<tr><td><strong>Firmware</strong></td><td>'.trim($disk_details[2]).'</td></tr>'.chr(10);

  echo '                            </table>';

  echo '                        </div>'.chr(10);
  echo '                    </div>'.chr(10);
  echo '                </div>'.chr(10);

  if ($count<2) {
    $count++;
  } else {
    echo '            </div>'.chr(10);
    $count=0;
  }
}
if ($count!=0) echo '            </div>'.chr(10);
?>

<?php
include 'footer.php';
?>
