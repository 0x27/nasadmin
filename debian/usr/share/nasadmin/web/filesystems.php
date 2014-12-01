<?php

$page_id=5;
include 'header.php';

$os_disk=trim(shell_exec('/usr/share/nasadmin/scripts/os/getosdisk'));

function byte_power($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor] . "B";
}
function action_button($uuid) {
  $content='                 <div class="btn-group">'.chr(10);
  $content.='                  <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">'.chr(10);
  $content.='                   Actions'.chr(10);
  $content.='                   <span class="caret"></span>'.chr(10);
  $content.='                  </button>'.chr(10);
  $content.='                  <ul class="dropdown-menu pull-right" role="menu">'.chr(10);
  $content.='                   <li><a href="#" onclick="doMount(\''.$uuid.'\')"><i class="fa fa-arrow-circle-right fa-fw"></i> Mount</a>'.chr(10);
  $content.='                   </li>'.chr(10);
  $content.='                   <li><a href="#" onclick="doUmount(\''.$uuid.'\')"><i class="fa fa-eject fa-fw"></i> Unmount</a>'.chr(10);
  $content.='                   </li>'.chr(10);
  $content.='                   <li class="divider"></li>'.chr(10);
  $content.='                   <li><a href="#"><i class="fa fa-arrows-alt fa-fw"></i> Resize</a>'.chr(10);
  $content.='                   </li>'.chr(10);
  $content.='                   <li><a href="#"><i class="fa fa-pie-chart fa-fw"></i> Quota</a>'.chr(10);
  $content.='                   </li>'.chr(10);
  $content.='                  </ul>'.chr(10);
  $content.='                 </div>'.chr(10);
  return $content;
}

exec('/usr/share/nasadmin/scripts/storage/getfs',$filesystems);


$table_content="";
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

  if ($count==0) echo '            <div class="row visible-xs-block visible-sm-block">'.chr(10);
  echo '             <div class="col-md-6 col-sm-12">'.chr(10);
  echo '              <div class="panel panel-';
  if (strpos($_dev,$os_disk)===0) echo "primary"; else echo "default";
  echo '">'.chr(10);
  echo '               <div class="panel-heading">'.chr(10);
  echo '                <i class="fa fa-folder-open fa-fw"></i> '.$_dev.chr(10);

  if (strpos($_dev,$os_disk)===false) {
    echo '                <div class="pull-right">'.chr(10);
    echo action_button($_uuid);
    echo '                </div>'.chr(10);
  } else {
    echo '                <div class="pull-right">'.chr(10);
    echo '                 System'.chr(10);
    echo '                </div>'.chr(10);
  }


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


  $table_content.="                 <tr>".chr(10);
  $table_content.="                  <td>".$_dev."</td>".chr(10);
  $table_content.="                  <td>".byte_power($_size,1).($_free!="" ? " (".byte_power($_free*1024,1).")" : "")."</td>".chr(10);
  $table_content.="                  <td>".$_fs."</td>".chr(10);
  $table_content.="                  <td>".$_mountpoint."</td>".chr(10);
  $table_content.="                  <td>".chr(10);

  $table_content.='                   <div class="progress">'.chr(10);
  $table_content.='                    <div class="progress-bar progress-bar-';
  if (strpos($_dev,$os_disk)===0) $table_content.="primary"; else $table_content.="success";
  $table_content.='" role="progressbar" aria-valuenow="'.$_used.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$_used.'%">'.chr(10);
  $table_content.='                     <span class="sr-only">'.$_used.'% used</span>'.chr(10);
  $table_content.='                    </div>'.chr(10);
  if ($_used=="") $table_content.='<p class="text-center">unmounted</p>';
  $table_content.='                   </div>'.chr(10);

  $table_content.='                  </td>'.chr(10);
  $table_content.='                  <td>'.chr(10);
  if (strpos($_dev,$os_disk)!==0) {
    $table_content.=action_button($_uuid);
  }
  $table_content.='                  </td>'.chr(10);
  $table_content.='                 </tr>'.chr(10);

  $count++;
  if ($count==2) {
    echo '            </div>'.chr(10);
    $count=0;
  }
} 

if ($count>0) {
  echo '            </div>'.chr(10);
}

echo '<div class="row visible-xs-block visible-sm-block">';
echo '<div class="col-md-4 col-sm-4">'.chr(10);
echo '<a href="#" onclick="doRescan()" class="btn btn-default btn-md"><i class="fa fa-refresh fa-fw"></i>Rescan</a>'.chr(10);
echo '</div>';
echo '</div>';

  echo chr(10).'            <!--   Start of table (med/large devices)   -->'.chr(10).chr(10);

  echo '            <div class="row visible-md-block visible-lg-block">'.chr(10);
  echo '             <div class="panel panel-default">'.chr(10);
  echo '              <div class="panel-heading">'.chr(10);
  echo '               Current File Systems'.chr(10);

  echo '               <div class="pull-right">'.chr(10);
  echo '                <a href="#" onclick="doRescan()" class="btn btn-default btn-xs">'.chr(10);
  echo '                 <i class="fa fa-refresh fa-fw"></i> Rescan'.chr(10);
  echo '                </a>'.chr(10);
  echo '               </div>'.chr(10);
  echo '              </div>';
  echo '              <div class="panel-body">'.chr(10);
  echo '               <div class="table">'.chr(10);
  echo '                <table class="table table-hover">'.chr(10);
  echo '                 <tr><th>Device</th><th>Size (Free)</th><th>File System</th><th>Mountpoint</th><th>Capacity Usage</th><th></th></tr>'.chr(10);
  echo $table_content; 
  echo '                </table>'.chr(10);
  echo '               </div>'.chr(10);
  echo '              </div>'.chr(10);
  echo '             </div>'.chr(10);
  echo '            </div>'.chr(10);

?>

<script>
function doRescan() {
  $.ajax({ url: "do_action.php?action=rescan" }).done(function(result) {
    location.reload();
  });
}

function doMount(uuid) {
  $.ajax({ url: "do_action.php?action=mount&uuid="+uuid }).done(function(result) {
    if (result.trim()=='true')
      location.reload();
    else 
      alert('failed');
  });
}

function doUmount(uuid) {
  $.ajax({ url: "do_action.php?action=umount&uuid="+uuid }).done(function(result) {
    if (result.trim()=='true')
      location.reload();
    else 
      alert('failed');
  });
}

</script>

<?php
include 'footer.php';
?>
