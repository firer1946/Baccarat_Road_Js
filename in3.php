<!DOCTYPE html>
<html lang="zh-CN">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<title>国际会<?php echo $_GET['tno']; ?>号桌</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/an.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="js/html5shiv.min.js"></script>
	  <script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="./js/jquery.min.js"></script>
	<script src="./js/grid.js"> </script>
<script>
		//----------websocket--------------------------------
		var tid = <?php echo $_GET['tid']; ?>;
		var socket;
		var saves2 = [];
		var tno;
		var getmsg;
		function connect(){
			try{
				socket=new WebSocket('ws://106.187.96.125:3335');
				// socket=new WebSocket('ws://121.42.149.138:3335');
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
			getmsg = 1;
			var obj = JSON.parse(msg.data);
			if($("#flag").text() == "flag"){   //第一次获取数据
				var ju;
				var status;
				// alert(obj.message[2].tno);
				// alert(tid);
				var tno = obj.message[tid].tno; //台号
				// alert(tno);
				ju = obj.message[tid].ju;   //路图原始数据
				var cur_xue = obj.message[tid].cur_xue_no; //当前靴
				var cur_ju = obj.message[tid].cur_ju_no;  //当前局
				var count = count_judge(ju);  //庄闲和个数的统计数据
				// alert(count);
				$(".taihao").html("台号："+tno);
				$(".xue").html("靴："+cur_xue);
				$(".ju").html("局："+cur_ju);
				$(".max").html("最高投注："+obj.message[tid].zhuang_max);
				$(".min").html("最低投注："+obj.message[tid].zhuang_min);
				$("#he_max").html("和注最高："+obj.message[tid].he_max);
				$("#he_min").html("和注最低："+obj.message[tid].he_min);
				$("#dui_max").html("对子最高："+obj.message[tid].zhuang_dui_max);
				$("#dui_min").html("对子最低："+obj.message[tid].zhuang_dui_min);
				$("#count_zhuang").html("<img src=\"img/zhupan_1.png\" height=\"30\" width=\"30\">"+count[0]);
				$("#count_xian").html("<img src=\"img/zhupan_5.png\" height=\"30\" width=\"30\">"+count[1]);
				$("#count_he").html("<img src=\"img/zhupan_9.png\" height=\"30\" width=\"30\">"+count[2]);
				$("#count_zhuangdui").html("<img src=\"img/zhupan_2.png\" height=\"30\" width=\"30\">"+count[3]);
				$("#count_xiandui").html("<img src=\"img/zhupan_7.png\" height=\"30\" width=\"30\">"+count[4]);
				for(var i = 0;i<obj.message.length;i++){
					var tno_tid = obj.message[i].tno;
					if(tno == obj.message[i].tno)
						$(".right").append("<a href=\"in3.php?tid="+i+"&tno="+obj.message[i].tno+"&video_url="+obj.message[i].video_url+"\" class=\"an-table-num text-center active\">"+obj.message[i].tno+"</a>");
					else
						$(".right").append("<a href=\"in3.php?tid="+i+"&tno="+obj.message[i].tno+"&video_url="+obj.message[i].video_url+"\" class=\"an-table-num text-center\">"+obj.message[i].tno+"</a>");
				}
				saves2 = fill_all(ju,"#tab");
				// alert(ju);
				// alert(saves2[0]);
				// sleep(1); 
				//----------------开始探路-----------------------------------------------
				// alert(ju);
				var tanlu= tanlu_new(ju); //探路
				$("#tanlu_zhuang").html("<img class=\"center-block\" src=\"img/dayanzai_"+tanlu[0][0]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaolu_"+tanlu[0][1]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaoqiang_"+tanlu[0][2]+".png\" height=\"20\" width=\"20\">");
				$("#tanlu_xian").html("<img class=\"center-block\" src=\"img/dayanzai_"+tanlu[1][0]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaolu_"+tanlu[1][1]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaoqiang_"+tanlu[1][2]+".png\" height=\"20\" width=\"20\">");
				
				// saves2[0] = ju;
				// alert(ju);
				
			}
			else{  						//更新数据部分
				// alert(saves2[0]);
				var newData = {};
				var obj = JSON.parse(msg.data);
				var ju;
				var status;
				ju = obj.message[tid].ju;
				tno = obj.message[tid].tno;
				//---------------清空数据---------------------------
				if(ju == ""){//清空数据状态
					var cur_xue = obj.message[tid].cur_xue_no; //当前靴
					var cur_ju = obj.message[tid].cur_ju_no;  //当前局
					fill_big_blank("#tab");
					fill_img_blank("#tab");
					$(".xue").html("靴："+cur_xue);
					$(".ju").html("局："+cur_ju);
					$("#tanlu_zhuang").html("<img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\">");
					$("#tanlu_xian").html("<img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/50.png\" height=\"20\" width=\"20\">");
					$("#count_zhuang").html("<img src=\"img/zhupan_1.png\" height=\"30\" width=\"30\">0");
					$("#count_xian").html("<img src=\"img/zhupan_5.png\" height=\"30\" width=\"30\">0");
					$("#count_he").html("<img src=\"img/zhupan_9.png\" height=\"30\" width=\"30\">0");
					$("#count_zhuangdui").html("<img src=\"img/zhupan_2.png\" height=\"30\" width=\"30\">0");
					$("#count_xiandui").html("<img src=\"img/zhupan_7.png\" height=\"30\" width=\"30\">0");
				// saves2[0] = ju;
					saves2= get_all(ju);
				}
				//---------------清空数据done------------------------
				else{
					newData= get_all(ju);
					if(ju.length < 66){
						var result = diff1(saves2[0],newData[0]);
						// alert(saves2[0]);
						zhupan_update(result,"#tab");
					}
					else{
							var zhupan_data =new Array();
							zhupan_data = ju.slice(-66,-1);
							zhupan_data.push(ju[ju.length-1]);
							fill_zhupan(zhupan_data,"#tab");
							
					}
					// var result2 = diff2(saves2[1],newData[1]);
					// dalu_update(result2,"#tab");
					// var result3 = diff3(saves2[2],newData[2]);
					// other_update(result3,11,6,"dayanzai","#tab");
					// var result4 = diff3(saves2[3],newData[3]);
					// var result5 = diff3(saves2[4],newData[4]);
					// other_update(result4,11,9,"xiaolu","#tab");
					// other_update(result5,28,9,"xiaoqiang","#tab");
					// alert(ju);
					update_dalu2(saves2[0],ju,11,0,"#tab");
					other_update_new(saves2[0],ju,11,6,"dayanzai",1,"#tab");
					other_update_new(saves2[0],ju,11,9,"xiaolu",2,"#tab");
					other_update_new(saves2[0],ju,28,9,"xiaoqiang",3,"#tab");
					var cur_xue = obj.message[tid].cur_xue_no; //当前靴
					var cur_ju = obj.message[tid].cur_ju_no;  //当前局
					var count = count_judge(ju);  //庄闲和个数的统计数据
					$(".xue").html("靴："+cur_xue);
					$(".ju").html("局："+cur_ju);
					$("#count_zhuang").html("<img src=\"img/zhupan_1.png\" height=\"30\" width=\"30\">"+count[0]); //填主盘统计数据
					$("#count_xian").html("<img src=\"img/zhupan_5.png\" height=\"30\" width=\"30\">"+count[1]);
					$("#count_he").html("<img src=\"img/zhupan_9.png\" height=\"30\" width=\"30\">"+count[2]);
					$("#count_zhuangdui").html("<img src=\"img/zhupan_2.png\" height=\"30\" width=\"30\">"+count[3]);
					$("#count_xiandui").html("<img src=\"img/zhupan_7.png\" height=\"30\" width=\"30\">"+count[4]);
					var tanlu= tanlu_new(ju); //探路
					$("#tanlu_zhuang").html("<img class=\"center-block\" src=\"img/dayanzai_"+tanlu[0][0]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaolu_"+tanlu[0][1]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaoqiang_"+tanlu[0][2]+".png\" height=\"20\" width=\"20\">");
					$("#tanlu_xian").html("<img class=\"center-block\" src=\"img/dayanzai_"+tanlu[1][0]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaolu_"+tanlu[1][1]+".png\" height=\"20\" width=\"20\"><img class=\"center-block\" src=\"img/xiaoqiang_"+tanlu[1][2]+".png\" height=\"20\" width=\"20\">");
					saves2 = newData;
				}

			}
		}
		function sClose(){
			// alert('connect close')
			connect();
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
			// alert(getmsg);
			// alert($("#flag").html());
			// var data = [5,9,1,5,9,1,5,9,1,5,5,5,1,5,5,5,1,5,5,5,9,1,5,5,1,5,1,5,1,5,1,5,5,5,5,5,9,1,5,5,1,5,5,5,5,1,5,5,5,1,5,1,5,1,5,5,5,5,5,1,1,5,5,9];  //原始数据		
			// var data1 = [5,5,5,5,1,9,5,5,5,5,5];
			// var data2 = [8,8,8,8,8,8,8,8,8,8,8,8,8,8,6,6,6]; 
			// var dalu_data = dalu(data);
			//var xiaolu_data = other(dalu_data,2);
			// 	xiaolu_data = convert6(xiaolu_data);//小路
			// // alert(xiaolu_data);
			// fill_all(data,"#tab");	
			// fill_all(data1,"#tab2");
			// fill_all(data2,"#tab3");
		});
</script>
	<style>
		.left-td>img{
		width: 37px;
		height: 37px;
		display: block;
		margin: 0;
		padding: 1px;
		}
		.left-td {
			width: 38px;
			height: 38px;
			display: block;
			margin: 0;
			padding: 0;
			border-top: hidden;
			border-left: hidden;
		}
		.right-td{
			width: 19px;
			height: 19px;
			display:block;
			margin: 0;
			padding: 0;
			border-top: none;
			border-left: none;
		}

		tr{
			float:left;
		}
		.right-tr>td:nth-child(n+1):nth-child(-n+6){
			background-size:cover;
		}
		.right-tr>td:nth-child(n+1):nth-child(-n+6)>img{
			width: 19px;
			height: 19px;
			display: block;
			margin: 0;
			padding: 0;
		}
		.right-tr>td:nth-child(n+7):nth-child(-n+12)>img{
			width: 9px;
			height: 9px;
			display: block;
			float:left;
		}
		ib{
			position: relative;
   			padding-left: 4px;
   	 		font-size: 15px;
    		color: green;

		}
	</style>
  </head>
  <body>
  <?php echo $_GET['id']; ?>
	<!-- <div class="an-body"> -->
		<!-- 导航 -->
		<nav class="navbar navbar-fixed-top navbar-in2 in3">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <a class="navbar-brand" href="./index.html">logo</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse">
			  <ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="#">会员</a></li> -->
				<li><a href="#">访客</a></li>
				<!-- <li><span class="an-time">2015/08/01 15:00</span></li> -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#">繁体中文</a></li> -->
						<li><a href="#">简体中文</a></li>
						<!-- <li><a href="#">ENGLISH</a></li> -->
						<!-- <li><a href="#">...</a></li>
						<li><a href="#">...</a></li> -->
						<li><a href="javascript:void(0);" data-toggle="modal" data-target="#yxgz">游戏规则</a></li>
						<!-- <li><a href="#">投注记录</a></li> -->
						<li><a href="#">退出</a></li>
					</ul>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="container-fluid an-banner-info">
			<div class="clearfix">
				<div class="pull-left">
					<span class="taihao"></span>
					<span class="xue"></span>
					<span class="ju"></span>
					<span class="dropdown">
						本台限红&nbsp;&nbsp;
						<span class="max"></span>
						<span class="min"></span>
						<a href="javascript:void(0);" class="dropdown-btn"><span class="glyphicon glyphicon-menu-down"></span></a>
						<!-- <i class="glyphicon glyphicon-menu-up"></i> -->
						<div class="toggle-box">
							<span id="he_max">和注最高：10005</span>
							<span id="he_min">和注最低：10005</span><br/>
							<span id="dui_max">对子最高：10005</span>
							<span id="dui_min">对子最低：10005</span>
						</div>
					</span>
				</div>
				<div class="pull-right">
					累计局数：
					<span id="count_zhuang"></span>
					<span id="count_xian"></span>
					<span id="count_he"></span>
					<span id="count_zhuangdui"></span>
					<span id="count_xiandui"></span>
				</div>
			</div>
		</div>
		<div class="container-fluid an-container in3">
			<div class="an-video-box">
				<div class="col-xs-6 text-center an-video">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"  codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="400" height="300"  id="flashvars" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="movie" value="VideoCamear.swf"  />
					<!-- <param name="FlashVars" value="url=rtmp://103.240.203.55/live/dvr_1_ch_2&width=650,500" /> -->
					<?php   
						echo "<param name=\"FlashVars\" value=\"url=".$_GET['video_url']."&width=650,500\" />";
					?>
					<param name="quality" value="high" /><param  name="bgcolor" value="#ffffff" />
					<!-- <embed src="VideoCamear.swf" FlashVars="url=rtmp://103.240.203.55/live/dvr_1_ch_2&width=650,500" quality="high"  name="flashvars" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"  pluginspage="http://www.macromedia.com/go/getflashplayer" width="625" height="480" style="background-color:#222;"/> -->
					<?php
						echo "<embed src=\"VideoCamear.swf\" FlashVars=\"url=".$_GET["video_url"]."&width=650,500\" quality=\"high\"  name=\"flashvars\" align=\"middle\" wmode=\"transparent\"  allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\"  pluginspage=\"http://www.macromedia.com/go/getflashplayer\" width=\"625\" height=\"480\" style=\"background-color:#222;\"/>";
					?>
					</object>
				</div>
				<div class="col-xs-6 an-video-boxbg"></div>
			</div>
			<div class="an-in3-table">
			<div class="left">
				<div>
					<p class="text-center">庄</p>
					<div id="tanlu_zhuang"></div>
					<!-- <img class="center-block" src="img/dalu_1.png" height="20" width="20" alt="">
					<img class="center-block" src="img/dalu_1.png" height="20" width="20" alt="">
					<img class="center-block" src="img/dalu_1.png" height="20" width="20" alt=""> -->
				</div>
				<div>
					<p class="text-center">闲</p>
					<div id="tanlu_xian"></div>
					<!-- <img class="center-block" src="img/dalu_1.png" height="20" width="20" alt="">
					<img class="center-block" src="img/dalu_1.png" height="20" width="20" alt="">
					<img class="center-block" src="img/dalu_1.png" height="20" width="20" alt=""> -->
				</div>
			</div>
			<div class="center" style="background-color:white;">
					<div style="width:2000px;background-color:white;">
							<table frame="void" width="100%" border="1" cellspacing="0" style="padding:0;margin:0;table-layout: fixed;background-color:white;" id="tab">
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
			<div class="right">
				<!-- <a href="javascript:void(0);" class="an-table-num text-center active">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2042</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a>
				<a href="javascript:void(0);" class="an-table-num text-center">2041</a> -->
			</div>
			</div>
			<p class="an-tip">最新消息：客户进行游戏</p>
			<!-- <p id="demo">123</p> -->
		</div>
		<div class="modal fade an-yxgz" id="yxgz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
	            <h4 class="modal-title"><i class="an-yxgz-logo"></i>百家乐游戏玩法</h4>
	          </div>
	          <div class="modal-body">
	            <p>“闲家” “庄家”各先派两张牌, 以“闲家”先发,如第一轮未分出胜负需再按“牌例”发第二轮的牌, 最多每方3张牌, 谁最接近9点即为胜方, 又相同点数即和局。</p>
	            <p>百家乐博牌规则：</p>
	            <table class="table table-condensed">
	            	<thead>
	            		<tr>
	            			<th>闲两牌合计点数(闲家)</th>
	            			<th>庄两牌合计点数(庄家)</th>
	            		</tr>
	            	</thead>
	            	<tbody>
	            		<tr>
	            			<td>0&nbsp;&nbsp;必须博牌</td>
	            			<td>0&nbsp;&nbsp;必须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>1&nbsp;&nbsp;必须博牌</td>
	            			<td>1&nbsp;&nbsp;必须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>2&nbsp;&nbsp;必须博牌</td>
	            			<td>2&nbsp;&nbsp;必须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>3&nbsp;&nbsp;必须博牌</td>
	            			<td>3&nbsp;&nbsp;若闲博得8毋须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>4&nbsp;&nbsp;必须博牌</td>
	            			<td>4&nbsp;&nbsp;若闲博得1, 8, 9, 10毋须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>5&nbsp;&nbsp;必须博牌</td>
	            			<td>5&nbsp;&nbsp;若闲博得1, 2, 3, 8, 9, 10毋须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>6&nbsp;&nbsp;不得博牌</td>
	            			<td>6&nbsp;&nbsp;若闲博得6, 7必须博牌</td>
	            		</tr>
	            		<tr>
	            			<td>7&nbsp;&nbsp;不得博牌</td>
	            			<td>7&nbsp;&nbsp;不得博牌</td>
	            		</tr>
	            		<tr>
	            			<td>8&nbsp;&nbsp;例牌, 即定胜负</td>
	            			<td>8&nbsp;&nbsp;例牌, 即定胜负</td>
	            		</tr>
	            		<tr>
	            			<td>9&nbsp;&nbsp;例牌, 即定胜负</td>
	            			<td>9&nbsp;&nbsp;例牌, 即定胜负</td>
	            		</tr>
	            	</tbody>
	            </table>
	            <p>庄闲任何一方两牌合计8、9点为例牌, 对方不须博牌, 即定胜负. 庄闲两方各得6、7点, 即和局。</p>
	            <ul class="list-unstyled">
	            	<li>●&nbsp;&nbsp;选择押庄赢 1赔0.95 抽水5%</li>
	            	<li>●&nbsp;&nbsp;选择押闲赢 1赔1 免抽水</li>
	            	<li>●&nbsp;&nbsp;选择押和局 1赔8 免抽水</li>
	            	<li>●&nbsp;&nbsp;选择押庄对 1赔11 免抽水</li>
	            	<li>●&nbsp;&nbsp;选择押闲对 1赔11 免抽水</li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	<!-- </div> -->
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(".dropdown-btn").on("click",function(){
			$(".toggle-box").toggle();
			if ($(".toggle-box").is(":visible")) {
				$(".dropdown-btn").html('<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>');
			} else {
				$(".dropdown-btn").html('<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>');
			};
		});
	</script>
  </body>
</html>
