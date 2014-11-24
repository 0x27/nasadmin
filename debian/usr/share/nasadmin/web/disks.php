<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Physical Disks | NAS Admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/plugins/timeline.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">

<?php include 'menu.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-hdd-o fa-fw"></i> Physical Disks</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<?php
$out=array();
$result=exec('/usr/share/nasadmin/scripts/storage/getdisks',$out);
//$out=array("sda","sdb","sdc","sdd","sde");
$count=0;
foreach ($out as $item) {
  if ($count==0) echo '            <div class="row">'.chr(10);

  echo '                <div class="col-lg-3 col-md-6 col-xs-6">'.chr(10);
  echo '                    <div class="panel panel-default">'.chr(10);
  echo '                        <div class="panel-heading">'.chr(10);

  echo '                            <i class="fa fa-hdd-o fa-fw"></i> '.split(' ',$item)[0].chr(10);

  echo '                        </div>'.chr(10);
  echo '                        <div class="panel-body">'.chr(10);

  echo '                            '.split(' ',$item)[1].'B'.chr(10);

  echo '                        </div>'.chr(10);
  echo '                    </div>'.chr(10);
  echo '                </div>'.chr(10);

  if ($count<3) {
    $count++;
  } else {
    echo '            </div>'.chr(10);
    $count=0;
  }
}
if ($count!=0) echo '            </div>'.chr(10);
?>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
</body>

</html>
