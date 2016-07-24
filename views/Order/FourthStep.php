<!DOCTYPE HTML>
<html>

<head>
    <base href="/cybusEasy/public/" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>我要訂票</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/order4.css" type="text/css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
    <!--<script type="text/javascript" src="javascript/Index.js"></script>-->
</head>

<body>
    <form method="post" action="" id=''>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <a href="Index.php"><img src="images/cybus.png" /></a>
                </div>
                <div class="menu">
                   <ul>
                    <li><a class="active">查詢及訂票</a></li>
                    <li><a href="Search1.php">我的車票</a></li>
                </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="background-image">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <div class="titleTxt">我要訂票</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <div class="OrderContent">
                                <div class="agreeTitle">訂票成功</div>
                                <div class="agreeContent">
                                    <?php  foreach($data['arr_data'] as $key => $val){?>
                                    <div class="marginB"><span>訂票姓名 :  </span><?php echo $val['clientName'];?></div>
                                    <div class="marginB"><span>身分證字號 :  </span><?php echo $val['clientId'];?></div>
                                    <div class="marginB"><span>電話 :  </span><?php echo $val['clientPhone'];?></div>
                                    <div class="marginB"><span>票種 :  </span><?php echo $val['type'];?></div>
                                    <div class="marginB"><span>張數 :  </span><?php echo $val['number'];?></div>
                                    <div><span class="f">--車程 :  <?php echo $val['start'];?> - <?php echo $val['end'];?></span></div>
                                    <div class="marginB"><span>乘車日期 :  </span><?php echo $val['date'];?></div>
                                    <div class="marginB"><span>乘車時間 :  </span><?php echo substr($val['time'],0,-3);?></div>
                                    
                                    
                                    <div class="marginB"><span>座位 :  </span><?php echo $val['seat'];?></div>
                                    <div class="marginB"><span>訂票時間 :  </span><?php echo $val['orderTime'];?></div>
                                    <div class="marginB"><span>總共金額 :  </span><?php echo $val['total'];?></div>
                                    
                                    <div>------------------------------------------------------</div>
                                    <div class="marginB"><span style="color:red;">取票代碼 :  </span><?php echo $val['ticrand'];?></div>
                                  *請於三日內，使用此代碼至便利商店輸入後取票
                                  <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
    </script>
    </form>
</body>


</html>