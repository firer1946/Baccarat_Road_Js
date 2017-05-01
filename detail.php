<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>视频页</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>国际会</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/an.css">
    <script src="js/jquery.min.js"></script>
    <script src="./js/grid.js"> </script>
	<style>/* 表格style*/
		#lutu{
			background-color: white;
		}
		.left-td>img{
			width: 46px;
			height: 46px;
			display: block;
			margin: 0;
			padding-left: 2px;
			padding-top: 2px;
		}
		/*.right-td>img{
			width: 25px;
			right: 25px;
			display: block;
			margin: 0;
			padding: 0;
		}*/
		.left-td {
			width: 52px;
			height: 52px;
			display: block;
			margin: 0;
			padding: 0;
		}
		.right-td{
			width: 26px;
			height: 26px;
			display:block;
			margin: 0;
			padding: 0;
			border-top: none;
			border-left: none;
		}
		/*.left-tr{
			float:left;
		}
		.right-tr{
			float: left;
		}*/
		tr{
			float:left;
		}
		.right-tr>td:nth-child(n+1):nth-child(-n+6)>img{
			width: 26px;
			height: 26px;
			display: block;
			margin: 0;
			padding: 0;
		}
		.right-tr>td:nth-child(n+7):nth-child(-n+12)>img{
			width: 12px;
			height: 12px;
			display: block;
			float: left;
		}
		ib{
			position: absolute;
			padding: 4px 8px;
			color:green;
			font-size:15px;
		}
	</style>
	<style>/*滚动条*/

		/* 主体 */
		#lk_scrollBox {width:1850px; height:400px; border:1px solid black; position:relative; overflow:hidden;border:0px;  }
		/* 滚动条 */
		#lk_scrollbar {width:560px; height:20px; background:#CCC;  position: absolute; left:20px; bottom:0;}
		#lk_handle {width:20px; height:20px; background:red; position:absolute; cursor:pointer;left:0px}
		/* 内容区 */
		#lk_scrollInner { width:1850px; height:330px; overflow:hidden; padding-bottom:20px;overflow-y:hidden;overflow-x:scroll}
		#lk_scrollInner #lk_content{ width:1800px;}
		#lk_scrollInner #lk_content div{ }
		/* 开始、结束按钮 */
		#lk_begin{ position:absolute; height:20px; width:20px; background:#666; left:-20px;}
		#lk_end{ position:absolute; height:20px; width:20px; background:#666; right:-20px;}
	</style>
	<style>/* 动画 */
			.spinner {
			  margin: 100px auto 0;
			  width: 150px;
			  text-align: center;
			}
			 
			.spinner > div {
			  width: 30px;
			  height: 30px;
			  background-color: #67CF22;
			 
			  border-radius: 100%;
			  display: inline-block;
			  -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
			  animation: bouncedelay 1.4s infinite ease-in-out;
			  /* Prevent first frame from flickering when animation starts */
			  -webkit-animation-fill-mode: both;
			  animation-fill-mode: both;
			}
			 
			.spinner .bounce1 {
			  -webkit-animation-delay: -0.32s;
			  animation-delay: -0.32s;
			}
			 
			.spinner .bounce2 {
			  -webkit-animation-delay: -0.16s;
			  animation-delay: -0.16s;
			}
			 
			@-webkit-keyframes bouncedelay {
			  0%, 80%, 100% { -webkit-transform: scale(0.0) }
			  40% { -webkit-transform: scale(1.0) }
			}
			 
			@keyframes bouncedelay {
			  0%, 80%, 100% {
			    transform: scale(0.0);
			    -webkit-transform: scale(0.0);
			  } 40% {
			    transform: scale(1.0);
			    -webkit-transform: scale(1.0);
			  }
			}
	</style>
	<script>
		 	//----------websocket--------------------------------
		var tid = <?php echo $_GET['tid']; ?> - 1;
  		var socket;
  		var saves = {};
  		var tno
		function connect(){
		    try{
		        socket=new WebSocket('ws://121.42.149.138:3335');
		    }catch(e){
		        alert('error');
		        return;
		    }
		    socket.onopen = send;
		    socket.onerror=sError;
		    socket.onmessage=sMessage;
		    socket.onclose=sClose
		 
		}
		function sError(){
    		alert('connect error')
		}
		function sMessage(msg){
			if($("#flag").text() == "flag"){   //第一次获取数据
			    var obj = JSON.parse(msg.data);
			    var ju;
			    var status;
		  		tno = obj.message[tid].tno;
		  		ju = obj.message[tid].ju;
		  		saves= fill_all(ju,"#tab");
			}
		  	else{  						//更新数据部分
		  		var newData = {};
		  		var obj = JSON.parse(msg.data);
		  		var ju;
		  		var status;
	  			ju = obj.message[tid].ju;
	  			tno = obj.message[tid].tno;
	  			newData= get_all(ju);
		  		
		  		var result = diff1(saves[0],newData[0]);
		  		zhupan_update(result,"#tab");
		  		var result2 = diff2(saves[1],newData[1]);
		  		dalu_update(result2,"#tab");
		  		var result3 = diff3(saves[2],newData[2]);
		  		other_update(result3,11,6,"dayanzai","#tab");
		  		var result4 = diff3(saves[3],newData[3]);
		  		var result5 = diff3(saves[4],newData[4]);
		  		other_update(result4,11,9,"xiaolu","#tab");
		  		other_update(result5,28,9,"xiaoqiang","#tab");
		  		saves = newData;

		  		
		  	}
		}
		function sClose(){
		    alert('connect close')
		}
		function send(){
		    var msg = {
		    "code" : "client-connect"
		    };
		    socket.send(JSON.stringify(msg));
		}
	//---------------websocket end--------------------------------	
		$(document).ready(function(){
			connect();
			// alert($("#flag").html());
			// var data = [5,9,1,5,9,1,5,9,1,5,5,5,1,5,5,5,1,5,5,5,9,1,5,5,1,5,1,5,1,5,1,5,5,5,5,5,9,1,5,5,1,5,5,5,5,1,5,5,5,1,5,1,5,1,5,5,5,5,5,1,1,5,5,9];  //原始数据		
		// var data1 = [5,5,5,5,1,9,5,5,5,5,5];
		// var data2 = [8,8,8,8,8,8,8,8,8,8,8,8,8,8,6,6,6]; 
		// var dalu_data = dalu(data);
	 // 	var xiaolu_data = other(dalu_data,2);
	 // 	xiaolu_data = convert6(xiaolu_data);//小路
		// // alert(xiaolu_data);
			// fill_all(data,"#tab");	
		// fill_all(data1,"#tab2");
		// fill_all(data2,"#tab3");
	});
	</script>
</head>
<body>
   	<nav class="navbar navbar-in2">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">logo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav nav-an">
            <li>
            	<div class="btn-group" role="group">
	            	<a href="#" class="btn active"><span class="glyphicon glyphicon-th"></span></a>
	            	<a href="#" class="btn"><span class="glyphicon glyphicon-th-large"></span></a>
	            	<a href="#" class="btn"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
            	</div>
            </li>
            <li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-sort-by-attributes"></span> 最高投注</a>
	            <ul class="dropdown-menu">
                    <li><a href="#">最低投注</a></li>
                    <li><a href="#">最低投注</a></li>
                 </ul>
            </li>
            <li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> 全选</a>
	            <ul class="dropdown-menu">
                    <li><a href="#">全选</a></li>
                    <li><a href="#">新濠天地</a></li>
                </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">会员</a></li>
            <li><a href="#">访客</a></li>
            <li><span class="an-time">2015/08/01 15:00</span></li>
            <li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
	            <ul class="dropdown-menu">
                    <li><a href="#">繁体中文</a></li>
                    <li><a href="#">简体中文</a></li>
                    <li><a href="#">ENGLISH</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">游戏规则</a></li>
                    <li><a href="#">投注记录</a></li>
                    <li><a href="#">退出</a></li>
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<div class="col-md-12" style="height:700px">
		<div class="col-md-6" style="height:470px" class="video">   
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100" height="100"> 
				<param name="movie" value="TestSwf.swf"> 
				<param name="quality" value="high"> 
				<param name="wmode" value="transparent"> 
				<embed src="TestSwf.swf" width="500" height="500" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent"></embed> 
			</object>
		</div>
		<div class="col-md-6" style="height:470px" class="other"> </div>
		<div class="col-md-12" id="lutu">
			<div id='lk_scrollBox'>
    			<div id="lk_scrollInner">
        			<div id="lk_content">
						<table width="102%" border="1" cellspacing="0" style="padding:0;margin:0;table-layout: fixed;" id="tab">
						 	<tr class="left-tr">
						 		<td class="left-td"><p style="display:none" id="flag">flag</p></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="left-tr">
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 		<td class="left-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						 	<tr class="right-tr">
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 		<td class="right-td"></td>
						 	</tr>
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>

<script type="text/javascript">
 //20131114 link by
 
	 jQuery(function(){
	                                
	    oParent=$('#lk_scrollbar');
	    oDiv1 = $('#lk_handle');
	    oDiv2 = $('#lk_scrollBox');
	    oDiv3 = $('#lk_scrollInner');
	    $begin = $('#lk_begin');
	    $end = $('#lk_end');
	    
	    oDiv1.width(30);
	    setTimeout(function(){
	        reScrollBox()
	    },1000)
	    //
	    reScrollBox=function (){
	        maxW = oDiv3[0].scrollWidth;
	        minW =oDiv2.width();
	        scale = minW/maxW;
	        oDiv1.width(oParent.width()*scale+30);
	        
	    }
	    //拖动事件方法
	    function moveDownSlide(l){
	        if(l<0){
	            l=0;
	        }else if(l > oParent.width()-oDiv1.width()){
	            l=oParent.width()-oDiv1.width();
	        }
	        oDiv1.css('left',l);
	        var scale=l/(oParent.width()-oDiv1.width());
	        oDiv3.scrollLeft((oDiv3[0].scrollWidth-oDiv2.width())*scale);
	        
	    }

	    //鼠标滚轮事件
	    oDiv3.bind('scroll',function(){
	        var scale=(oDiv3[0].scrollWidth-oDiv2.width())/(oParent.width()-oDiv1.width());
	        var t = $(this).scrollLeft()/scale;
	        oDiv1.css('left',t)
	        
	    });
	    //鼠标拖动事件
	    oDiv1[0].onmousedown=function (ev){
	        ev=ev||window.event;
	        var disX=ev.clientX - oDiv1.position().left;

	        document.onmousemove=function (ev){
	            ev=ev||window.event;
	            var l=ev.clientX-disX;
	            moveDownSlide(l);
	        };
	        document.onmouseup=function (){
	            document.onmousemove=null;
	            document.onmouseup=null;
	        };
	        $(document).bind('selectstart',function(ev){  // 防止页面内容被选中 IE 
	            return false;
	        });
	    };
	    //键盘上下事件
	    $(window).keydown(function(ev){
	        
	        var sLeft = oDiv3.scrollLeft();
	        var maxW = oDiv3[0].scrollWidth - oDiv3.width();
	        
	        switch(ev.keyCode) {
	            case 37:
	                    funLeft(sLeft - 50 > 0 ? sLeft - 50 : 0);
	                    break;
	            case 39:
	                    funLeft(sLeft + 50 < maxW ? sLeft + 50 : maxW);
	                    break;
	        }
	        function funLeft(sLeft){
	            oDiv3.scrollLeft(sLeft)
	            var t = oDiv3.scrollLeft()*scale;
	            var maxT = oParent.width() - oDiv1.width();
	            oDiv1.css('left',(t < maxT ? t : maxT) );
	            
	        }
	        
	    })
	    $begin.click(function(){
	        
	        moveDownSlide(0);
	        
	    })
	    $end.click(function(){
	        
	        moveDownSlide(1000);//1000为大于宽度的值
	        
	    })
	 });
 
 
 </script>
</body>
</html>