<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
<style>
	/*.left-table{
		table-layout: fixed;
		border-right: none;
	}
	.left-table td{
		width: 50px;
		height: 50px;
	}
	.left-table>tr>td:last-child{
		border-right: none;
	}
	.left-table td>img{
		width: 50px;
		height: 50px;
		display: block;
		margin: 0;
		padding: 0;
	}
	.right-table{
		table-layout: fixed;
	}
	.right-table td{
		width: 25px;
		right: 25px;
	}
	.right-table td>img{
		width: 25px;
		right: 25px;
		display: block;
		margin: 0;
		padding: 0;
	}
	.left-table .float-left>img{
		width: 25px;
		height: 25px;
		float: left;
	}*/
	.left-td>img{
		width: 52px;
		height: 52px;
		display: block;
		margin: 0;
		padding: 0;
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
		width: 13px;
		height: 13px;
		display: block;
		float: left;
	}
</style>

</head>
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"> </script>
<script src="../allins/js/grid.js"> </script>
<script>
	// function convert6(data){//数组转换成6行数组
	// 	var rec = new Array();
	// 	for (var i = 0 ;i < data.length+10	;i++){ //数组初始化
	// 		rec[i]  = new Array();
	// 		for(var j = 0;j < 6;j++){
	// 			rec[i][j] = "none";
	// 		}
	// 	}
	// 	for(var i = 0;i < data.length;i++){
	// 		var shift = i;
	// 		var row = 100;
	// 		var flag = 0;//开始换列的标志
	// 		for (var j=0;j < data[i].length;j++){
	// 			if(rec[i][j] != "none" || rec[i][j] == undefined || flag == 1){
	// 				shift ++;
	// 				flag = 1;
	// 				if(j-1 < row)
	// 					row = j-1;
	// 				// debugger;
	// 				rec[shift][row] = data[i][j];
	// 			}
	// 			else
	// 				rec[i][j]=data[i][j];
	// 		}
	// 	}
	// 	return rec;fdf
	// }
	// function judge(x){//根据数字判断庄闲和状态
	// 	if(x>=1 && x<=4)
	// 		return 1; //庄
	// 	else if(x>=5 && x<=8)
	// 		return -1; //闲
	// 	else if(x>=9 && x<=12)
	// 		return 0; //和
	// 	else
	// 		return "nothing about zxh";
	// }
	// function dalu(data){//生成大路图数组
	// 	var dalu = new Array();
	// 	var num_he = 0;//和的个数
	// 	var status;//表示当前状态（庄或者闲,1表示庄，0表示闲）
	// 	var col = 0;//表示到了第几个子数组
	// 	var last_status;//上一个状态
	// 	var last = data[data.length-1];
	// 	var val;//for循环存值
	// 	var he_length = 2;
	// 	// alert(data.length);
	// 	for(var i = 2;i < data.length+2;i++){  //获取最后不是和的值并写入第一个
	// 		// alert(last);
	// 		if(last>=1 && last<=8){
	// 			dalu.push([[last,num_he]]);
	// 			var he_length = num_he+he_length;//最后都是和的长度
	// 			num_he = 0;
	// 			break;
	// 		}	
	// 		else{
	// 			num_he++;
	// 			last = data[data.length-i];
	// 		}
			
	// 	}
	// 	// alert(data);

	// 	for (i=data.length-he_length;i>=0;i--){
	// 		val = data[i];//value
	// 		if(val>0 && val<9 && i>=0){
	// 			var dalu_col_last = dalu[col][dalu[col].length - 1];
	// 			if(judge(dalu_col_last[0]) != judge(val)){
	// 				col++;
	// 				dalu.push([]);
	// 			}
	// 			dalu[col].push([val,num_he]);
	// 			num_he = 0;
	// 			debugger;
	// 		}
	// 		else{
	// 			num_he++;
	// 		}
	// 	}
	// 	for (i in dalu){
	// 		dalu[i].reverse();
	// 	}
	// 	dalu.reverse();  //数组取逆
	// 	return dalu; //大路图生成//大路图生成//大路图的生成/生成大路图
	// }	
	// function other(data,mod){//其他路图的生成，data表示数组，mod表示路图类型（1,2,3）
	// 	var receive = [[]];//存新数组的容器
	// 	var result;//存一轮循环的结果，1表示红，0,表示蓝
	// 	var col = 0;//确定receive的第几个子数组	
	// 	for(var i = mod;i<data.length;i++){
	// 		for(var j=0;j<data[i].length;j++){
	// 			if(i==mod && j==0)
	// 				continue;
	// 			else if(j==0){ //判断齐整
	// 				if(data[i-mod-1].length == data[i-1].length)
	// 					result = 1;
	// 				else
	// 					result = 0;
	// 			}
	// 			else{//关于有无和直落的判断
	// 				if(data[i-mod][j] == undefined || data[i-mod][j] == ""){
	// 					if(data[i-mod][j-1] == undefined || data[i-mod][j-1] == "")
	// 						result = 1;
	// 					else
	// 						result = 0;
	// 				}
	// 				else{
	// 					result = 1;
	// 				}
	// 			}
	// 			//-----------插入数据部分----------------
	// 			if(receive[0][0] == undefined)
	// 				receive[0].push(result);
	// 			else{
	// 				var last = receive[col][receive[col].length - 1];
	// 				if(result != last){ //判断和最后那个颜色是否相同，不同就换行
	// 					col ++;
	// 					receive.push([]);
	// 				}
	// 				receive[col].push(result);
	// 			}
	// 			//----------end------------------------
	// 		}
	// 	}
	// 	return receive;
	// }
	// function smart_img(data){//四个图片格子的数组生成。
	// 	var rec = new Array();
	// 	for (var i = 0 ;i <= (data.length-1)/2;i++){ //数组初始化
	// 		rec[i]  = new Array();
	// 		for(var j = 0;j < 3;j++){
	// 			rec[i][j] = new Array(4);
	// 		}
	// 	}
	// 	for (var i = 0;i<rec.length;i++){
	// 		for(var j = 0;j<3;j++){
	// 			if(data[2*i+1] == undefined){
	// 					rec[i][j][1] = "blank";
	// 					rec[i][j][3] = "blank";
	// 					if(data[2*i][2*j] == "none")
	// 						rec[i][j][0] = "blank";
	// 					else
	// 						rec[i][j][0] = data[2*i][2*j];
						
	// 					if(data[2*i][2*j + 1] == "none")
	// 						rec[i][j][2] = "blank";
	// 					else
	// 						rec[i][j][2] = data[2*i][2*j+1];
					
	// 			}
	// 			else{
	// 				// for (var m = 0;m<2;m++){
	// 				// 	for(var n = 0;n<2;n++){
	// 				// 		if (data[2*i+n][2*i+m] == "none")
	// 				// 			rec[i][j][2*m+n] == "blank";
	// 				// 		else
	// 				// 			rec[i][j][2*m+n] = data[2*i+n][2*i+m];

	// 				// 	}
	// 				// }
	// 				if(data[2*i][2*j] == "none")
	// 						rec[i][j][0] = "blank";
	// 				else
	// 					rec[i][j][0] = data[2*i][2*j];
					
	// 				if(data[2*i][2*j + 1] == "none")
	// 					rec[i][j][2] = "blank";
	// 				else
	// 					rec[i][j][2] = data[2*i][2*j+1];

	// 				if(data[2*i+1][2*j] == "none")
	// 						rec[i][j][1] = "blank";
	// 				else
	// 					rec[i][j][1] = data[2*i+1][2*j];
					
	// 				if(data[2*i+1][2*j + 1] == "none")
	// 					rec[i][j][3] = "blank";
	// 				else
	// 					rec[i][j][3] = data[2*i+1][2*j+1];
	// 			}
	// 		}
	// 	}
	// 	return rec;
	// }	
	// function fill_img(xiaolu_data,colplus,rowplus,pic_name,selector){//用于填图的函数，分表表示数据，纵向位移量，横向位移量，图片名字,选择器
	// 	for(var i = 0;i<xiaolu_data.length;i++){//填小路图
	// 		for(var j = 0 ;j < xiaolu_data[i].length;j++){
	// 			for(var k = 0;k<xiaolu_data[i][j].length;k++){
	// 				var col = i+colplus;
	// 				var row = j+rowplus;
	// 				// alert(xiaolu_data[i][j][k]);
	// 				if(xiaolu_data[i][j][k] == "blank" )
	// 					$(selector + " tr:eq("+col+") td:eq("+row+") img:eq("+k+")").attr("src","50.png");
	// 				else
	// 					$(selector + " tr:eq("+col+") td:eq("+row+") img:eq("+k+")").attr("src",pic_name+"_"+xiaolu_data[i][j][k]+".png");
	// 			}
				
	// 		}
	// 	}
	// }
	// function getfill_data(data,category){//生成最后的填入数据，category(1,2,3)分别表示三种模式
	// 	var dalu_data = dalu(data);
	//  	var xiaolu_data = other(dalu_data,category);
	//  	xiaolu_data = smart_img(convert6(xiaolu_data));//小路
	//  	return xiaolu_data;
	// }
	// function fill_zhupan(data,selector){//填主盘
	// 	var num = 0;
	// 	len = data.length;
	// 	for(var i=0;i<11;i++){ 
	// 		for(var j=0;j<6;j++){
 //  				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='zhupan_"+data[num]+".png'>");
 //  				num++;
 //  				if (num == len)
 //  					break;

	// 		}
	// 		if (num == len)
 //  					break;
	// 	} //填主盘的函数 
	// }
	// function fill_dalu(dalu_6,selector){//填大路图
	// 	for(var i = 0;i<dalu_6.length;i++){
	// 		for(var j = 0 ;j < dalu_6[i].length;j++){
	// 			if(dalu_6[i][j] == "none") continue;
	// 				var col = i+11;
	// 				if(dalu_6[i][j][1] != 0 )
	// 					$(selector+" tr:eq("+col+") td:eq("+j+")").html("<ib style='position: absolute;padding: 4px 8px;color:green;'>"+dalu_6[i][j][1]+"</ib><img src='dalu_"+dalu_6[i][j][0]+"_he.png'>");
	// 				else
	// 					$(selector+" tr:eq("+col+") td:eq("+j+")").html("<img src='dalu_"+dalu_6[i][j][0]+".png'>");
				
	// 		}
	// 	}  
	// }
	// function fill_img_blank(selector){//填1像素空白图片
	// 	var num = 0;
	// 	for(var i=11;i<51;i++){//填1像素空白图片 右边下部分
	// 		for(var j=6;j<12;j++){
 //  				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='50.png'><img src='50.png'><img src='50.png'><img src='50.png'>");
 //  				num++;
	// 		}
	// 	} 
	// }
	// function fill_all(data,selector){
	// 	var dalu_data = dalu(data);
	// 	xiaolu_data = getfill_data(data,1);
	// 	zhonglu_data = getfill_data(data,2);
	// 	weilu_data = getfill_data(data,3);
	// 	dalu_6 = convert6(dalu_data);  //大路填入数据
	// 	//-----------------------填图---------------------------------------------
	// 	fill_img_blank(selector)
	// 	//**************后三个路图***********************
	// 	fill_img(xiaolu_data,11,6,"dayanzai",selector);
	// 	fill_img(zhonglu_data,11,9,"xiaolu",selector);
	// 	fill_img(weilu_data,31,9,"xiaoqiang",selector);
	// 	//*******************************************

	// 	fill_dalu(dalu_6,selector);
	// 	fill_zhupan(data,selector);
	// 	//-----------------------填图end----------------------------------
	// }
</script>
<script>
	$(document).ready(function(){
		var data = [5,9,1,5,9,1,5,9,1,5,5,5,1,5,5,5,1,5,5,5,9,1,5,5,1,5,1,5,1,5,1,5,5,5,5,5,9,1,5,5,1,5,5,5,5,1,5,5,5,1,5,1,5,1,5,5,5,5,5,1,1,5,5,9];  //原始数据		
		var data1 = [5,5,5,5,1,9,5,5,5,5,5];
		var data2 = [8,8,8,8,8,8,8,8,8,8,8,8,8,8,6,6,6]; 
		var dalu_data = dalu(data);
	 	var xiaolu_data = other(dalu_data,2);
	 	xiaolu_data = convert6(xiaolu_data);//小路
		alert(xiaolu_data);
		// fill_all(data,"#tab");	
		// fill_all(data1,"#tab2");
		// fill_all(data2,"#tab3");
	});
</script>
<body>
	<table width="100%" border="1" cellspacing="0" style="padding:0;margin:0;table-layout: fixed;" id="tab">
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
	<table width="100%" border="1" cellspacing="0" style="padding:0;margin:0;table-layout: fixed;" id="tab2">
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
	<table width="100%" border="1" cellspacing="0" style="padding:0;margin:0;table-layout: fixed;" id="tab3">
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
	<p id="demo"></p>
	<br/><br/>
	<p id="demo2"></p>
	<br/><br/>
	<p id="demo3"></p>
	<br/><br/>
	<p id="demo4"></p>
	<br/><br/>
	<p id="demo5"></p>
	<br/><br/>
	<p id="demo6"></p>
</body>
</html>