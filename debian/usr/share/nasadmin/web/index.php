<?php

$page_id=0;
include 'header.php';

$script_dir="/usr/share/nasadmin/scripts/";

$os_release=shell_exec($script_dir . "os/getos");
$kernel=shell_exec("uname -r");
//$cpu_usage=trim(shell_exec($script_dir . "os/getcpu"));
$ram_usage=round(trim(shell_exec($script_dir . "os/getmem")));

exec($script_dir."storage/getdisks",$disks);
$disk_count=count($disks);
unset($disks);
?>



            <div class="row">

                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hdd-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $disk_count; ?></div>
                                    <div>Physical Disk<?php if ($disk_count>1) echo "s"; ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="disks.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">1</div>
                                    <div>RAID Groups</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cubes fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">4</div>
                                    <div>Services</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-xs-12">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-envelope fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Messages</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list-alt fa-fw"></i> System Information 
                        </div>
                        <div class="panel-body">
                            <table class="table borderless">
                              <tr><td><strong>Operating System</strong></td><td><?php echo $os_release; ?></td></tr>
                              <tr><td><strong>Kernel<strong></td><td><?php echo $kernel; ?></td></tr>
                              <tr><td><strong>NAS Admin</strong></td><td><span style="color:red;">0.9</span></td></tr>
                            </table>
                        </div>
		    </div>
		</div>


                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tachometer fa-fw"></i> System Statistics 
                        </div>
                        <div class="panel-body">
                            <strong>CPU Utilisation</strong>
                            <span class="pull-right text-muted" id="cpu_usage_text">0%</span>
                            <div class="progress">
                              <div class="progress-bar progress-bar-info" id="cpu_usage_bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span class="sr-only" id="cpu_usage_sr">0%</span>
                              </div>
                            </div>
                            <strong>Memory Usage</strong>
                            <span class="pull-right text-muted"><?php echo $ram_usage; ?>%</span>
                            <div class="progress">
                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $ram_usage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ram_usage; ?>%">
                                <span class="sr-only">1%</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <script>
      function updatecpu() {
        $.ajax({ url: "getcpu.php" }).done(function(result) {
         var cpunum=Math.round(parseInt(result.trim()));
         $('#cpu_usage_bar').css("width",cpunum+"%").attr('aria-valuenow', cpunum);        
         $('#cpu_usage_text').text(cpunum+"%");
         $('#cpu_usage_sr').text(cpunum+"%");
        });
      }

      setInterval(updatecpu,2000);
    </script>
<?php
include 'footer.php';
?>
