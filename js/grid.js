	function convert6(data){//数组转换成6行数组
		var rec = new Array();
		for (var i = 0 ;i < data.length	;i++){ //数组初始化
			rec[i]  = new Array();
			for(var j = 0;j < 6;j++){
				rec[i][j] = "none";
			}
		}
		for(var i = 0;i < data.length;i++){
			var shift = i;
			var row = 100;
			var flag = 0;//开始换列的标志
			for (var j=0;j < data[i].length;j++){
				if(rec[i][j] != "none" || rec[i][j] == undefined || flag == 1){
					shift ++;
					if(rec[shift] == undefined)
						rec.push(["none","none","none","none","none","none"]);
					flag = 1;
					if(j-1 < row)
						row = j-1;
					// debugger;
					rec[shift][row] = data[i][j];
				}
				else
					rec[i][j]=data[i][j];
			}
		}
		return rec;
	}
	function judge(x){//根据数字判断庄闲和状态
		if(x>=1 && x<=4)
			return 1; //庄
		else if(x>=5 && x<=8)
			return -1; //闲
		else if(x>=9 && x<=12)
			return 0; //和
		else
			return "nothing about zxh";
	}
	function dalu(data){//生成大路图数组
		var dalu = new Array();
		var num_he = 0;//和的个数
		var status;//表示当前状态（庄或者闲,1表示庄，0表示闲）
		var col = 0;//表示到了第几个子数组
		var last_status;//上一个状态
		var last = data[data.length-1];
		var val;//for循环存值
		var he_length = 2;
		// alert(data.length);
		for(var i = 2;i < data.length+2;i++){  //获取最后不是和的值并写入第一个
			// alert(last);
			if(last>=1 && last<=8){
				dalu.push([[last,num_he]]);
				var he_length = num_he+he_length;//最后都是和的长度
				num_he = 0;
				break;
			}	
			else{
				num_he++;
				last = data[data.length-i];
			}
			
		}
		// alert(data);

		for (i=data.length-he_length;i>=0;i--){
			val = data[i];//value
			if(val>0 && val<9 && i>=0){
				var dalu_col_last = dalu[col][dalu[col].length - 1];
				if(judge(dalu_col_last[0]) != judge(val)){
					col++;
					dalu.push([]);
				}
				dalu[col].push([val,num_he]);
				num_he = 0;
				// debugger;
			}
			else{
				num_he++;
			}
		}
		for (i in dalu){
			dalu[i].reverse();
		}
		dalu.reverse();  //数组取逆
		return dalu; //大路图生成//大路图生成//大路图的生成/生成大路图
	}	
	function other(data,mod){//其他路图的生成，data表示大路数组，mod表示路图类型（1,2,3）
		var receive = [[]];//存新数组的容器
		var result;//存一轮循环的结果，1表示红，0,表示蓝
		var col = 0;//确定receive的第几个子数组	
		for(var i = mod;i<data.length;i++){
			for(var j=0;j<data[i].length;j++){
				if(i==mod && j==0)
					continue;
				else if(j==0){ //判断齐整
					if(data[i-mod-1].length == data[i-1].length)
						result = 1;
					else
						result = 0;
				}
				else{//关于有无和直落的判断
					if(data[i-mod][j] == undefined || data[i-mod][j] == ""){
						if(data[i-mod][j-1] == undefined || data[i-mod][j-1] == "")
							result = 1;
						else
							result = 0;
					}
					else{
						result = 1;
					}
				}
				//-----------插入数据部分----------------
				if(receive[0][0] == undefined)
					receive[0].push(result);
				else{
					var last = receive[col][receive[col].length - 1];
					if(result != last){ //判断和最后那个颜色是否相同，不同就换行
						col ++;
						receive.push([]);
					}
					receive[col].push(result);
				}
				//----------end------------------------
			}
		}
		return receive;
	}
	function smart_img(data){//四个图片格子的数组生成。
		var rec = new Array();
		for (var i = 0 ;i <= (data.length-1)/2;i++){ //数组初始化
			rec[i]  = new Array();
			for(var j = 0;j < 3;j++){
				rec[i][j] = new Array(4);
			}
		}
		for (var i = 0;i<rec.length;i++){
			for(var j = 0;j<3;j++){
				if(data[2*i+1] == undefined){
						rec[i][j][1] = "blank";
						rec[i][j][3] = "blank";
						if(data[2*i][2*j] == "none")
							rec[i][j][0] = "blank";
						else
							rec[i][j][0] = data[2*i][2*j];
						
						if(data[2*i][2*j + 1] == "none")
							rec[i][j][2] = "blank";
						else
							rec[i][j][2] = data[2*i][2*j+1];
					
				}
				else{
					if(data[2*i][2*j] == "none")
							rec[i][j][0] = "blank";
					else
						rec[i][j][0] = data[2*i][2*j];
					
					if(data[2*i][2*j + 1] == "none")
						rec[i][j][2] = "blank";
					else
						rec[i][j][2] = data[2*i][2*j+1];

					if(data[2*i+1][2*j] == "none")
							rec[i][j][1] = "blank";
					else
						rec[i][j][1] = data[2*i+1][2*j];
					
					if(data[2*i+1][2*j + 1] == "none")
						rec[i][j][3] = "blank";
					else
						rec[i][j][3] = data[2*i+1][2*j+1];
				}
			}
		}
		return rec;
	}	
	function fill_img(xiaolu_data,colplus,rowplus,pic_name,selector){//用于填图的函数，分表表示数据，纵向位移量，横向位移量，图片名字,选择器
		for(var i = 0;i<xiaolu_data.length;i++){//填小路图
			for(var j = 0 ;j < xiaolu_data[i].length;j++){
				for(var k = 0;k<xiaolu_data[i][j].length;k++){
					var col = i+colplus;
					var row = j+rowplus;
					// alert(xiaolu_data[i][j][k]);
					if(xiaolu_data[i][j][k] == "blank" )
						$(selector + " tr:eq("+col+") td:eq("+row+") img:eq("+k+")").attr("src","./img/50.png");
					else
						$(selector + " tr:eq("+col+") td:eq("+row+") img:eq("+k+")").attr("src","./img/"+pic_name+"_"+xiaolu_data[i][j][k]+".png");
				}
				
			}
		}
	}
	function getfill_data(data,category){//生成最后的填入数据，category(1,2,3)分别表示三种模式
		var dalu_data = dalu(data);
	 	var xiaolu_data = other(dalu_data,category);
	 	xiaolu_data = smart_img(convert6(xiaolu_data));//小路
	 	return xiaolu_data;
	}
	function fill_zhupan(data,selector){//填主盘
		if (data.length == 0)
			return 0;
		var num = 0;
		len = data.length;
		for(var i=0;i<11;i++){ 
			for(var j=0;j<6;j++){
  				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='./img/zhupan_"+data[num]+".png'>");
  				num++;
  				if (num == len)
  					break;

			}
			if (num == len)
  					break;
		} //填主盘的函数 
	}
	function fill_dalu(dalu_6,colplus,selector){//填大路图
		for(var i = 0;i<dalu_6.length;i++){
			for(var j = 0 ;j < dalu_6[i].length;j++){
				if(dalu_6[i][j] == "none") continue;
					var col = i+colplus;
					if(dalu_6[i][j][1] != 0 ){
						$(selector+" tr:eq("+col+") td:eq("+j+")").html("<ib>"+dalu_6[i][j][1]+"</ib>");
						$(selector+" tr:eq("+col+") td:eq("+j+")").css({"background-image":"url(./img/dalu_"+dalu_6[i][j][0]+"_he.png)"});
						// $(selector+" tr:eq("+col+") td:eq("+j+")").css("background-size","cover");
					}
					else{
						// $(selector+" tr:eq("+col+") td:eq("+j+")").html("<img src='./img/dalu_"+dalu_6[i][j][0]+".png'>");
						// $(selector+" tr:eq("+col+") td:eq("+j+")").css({"background-image":"url(./img/dalu_1.png)"});	
						$(selector+" tr:eq("+col+") td:eq("+j+")").css({"background-image":"url(./img/dalu_"+dalu_6[i][j][0]+".png)"});
					}
				
			}
		}  
	}
	function fill_img_blank(selector){//填1像素空白图片
		var num = 0;
		for(var i=11;i<51;i++){//填1像素空白图片 右边下部分
			for(var j=6;j<12;j++){
  				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='./img/50.png'><img src='./img/50.png'><img src='./img/50.png'><img src='./img/50.png'>");
  				num++;
			}
		} 
	}
	function fill_big_blank(selector){ //大路和主盘填空白图片
		var num = 0; //主盘
		for(var i =0 ;i< 11;i++){
			for(var j =0;j<6;j++){
				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='./img/50.png'>");
				num ++;
			}
		}
		num = 0;
		for(i=11;i<51;i++){//大路
			for(j=0;j<6;j++){
  				$(selector+" tr:eq("+i+") td:eq("+j+")").html("<img src='./img/50.png'>");
  				$(selector+" tr:eq("+i+") td:eq("+j+")").css("background-image","url(./img/50.png)");
  				num++;
			}
		} 
	}
	function fill_all(data,selector){//填所有的数据并把各个路图的数据返回
		var zhupan_data = data;
		if(data.length > 66){
			zhupan_data = data.slice(-66,-1);
			zhupan_data.push(data[data.length-1]);
		}
		var dalu_data = dalu(data);
		var xiaolu_data = getfill_data(data,1);
		var zhonglu_data = getfill_data(data,2);
		var weilu_data = getfill_data(data,3);
		var dalu_6 = convert6(dalu_data);  //大路填入数据
		//-----------------------填图---------------------------------------------
		fill_img_blank(selector);
		fill_big_blank(selector);
		//**************后三个路图***********************
		fill_img(xiaolu_data,11,6,"dayanzai",selector);
		fill_img(zhonglu_data,11,9,"xiaolu",selector);
		fill_img(weilu_data,28,9,"xiaoqiang",selector);
		//*******************************************

		fill_dalu(dalu_6,11,selector);
		fill_zhupan(zhupan_data,selector);
		//-----------------------填图end----------------------------------
		var save = new Array();
		save.push(data,dalu_6,xiaolu_data,zhonglu_data,weilu_data);
		return save;
	}
	function get_all(data,selector){//获取所有路图的数据
		var dalu_data = dalu(data);
		var xiaolu_data = getfill_data(data,1);
		var zhonglu_data = getfill_data(data,2);
		var weilu_data = getfill_data(data,3);
		var dalu_6 = convert6(dalu_data);  //大路填入数据
		var save = new Array();
		save.push(data,dalu_6,xiaolu_data,zhonglu_data,weilu_data);
		return save;
	}
	function diff1(arr1,arr2){//主盘更新比较，其他路图更新比较，arr1为缓存数据，arr2为新数据
		var res = new Array();
		if(arr2.length > arr1.length)
			res.push([arr2.length-1,arr2[arr2.length-1]]);
		else
			res.push([arr1.length-1,"back"]);
		return res;
	}
	function diff2(arr1,arr2){//大路图更新比较，其他路图更新比较，arr1为缓存数据，arr2为新数据
		// alert(arr2.length);
		var res = new Array();
		if(arr1.length == 0 && arr2.length==0){//都为空时，也就是一直为空不更新时
			return 0;
		}
		if(arr1.length == 0 || arr2.length==0){
			res.push([0,0,arr2[0][0]]);
			return res;
		}
		if(arr1.length == arr2.length){
			// alert("true");
			last = arr1.length-1;
			// alert(last);
			for(var i = 0;i<arr2[last].length;i++){
				if(arr1[last][i][0] != arr2[last][i][0] || arr1[last][i][1] != arr2[last][i][1] || arr2[last][i] != "none")
					res.push([last,i,arr2[last][i]]);
			}
		}
		else{
			var last = arr2[arr2.length - 1];
			for(var i = 0;i<last.length;i++){
				if(last[i] != "none")
					res.push([arr2.length-1,i,last[i]]);
			}

		}
		return res;
	}
	function diff3(arr1,arr2){//其他路图更新比较，arr1为缓存数据，arr2为新数据
		var res = new Array();
		if(arr1.length == arr2.length){
			// alert("true");
			var last = arr1.length-1;
			// alert(arr2[last].length);
			// alert(arr1[last][0][]);
			for(var i = 0;i<arr2[last].length;i++){
				for(var j =0;j<arr2[last][i].length;j++){
						if (arr1[last][i][j] != arr2[last][i][j] && arr2[last][i][j] != "blank")
							res.push([last,i,j,arr2[last][i][j]]); 
					}
			}
		}
		else{
			var last = arr2[arr2.length - 1];
			for(var i = 0;i<last.length;i++){
				for(var j =0;j<last[i].length;j++){
					if(last[i][j] != "blank")
						res.push([arr2.length-1,i,j,last[i][j]]);
				}
			}

		}
		return res;
	}
	function zhupan_update(data,selector){  //主盘的更新
		for(var i =0;i < data.length;i++){
			var num = data[i][0];
			var row = parseInt(num/6);
			var col = num%6;
			// alert("row:"+row+"col:"+col);
			if(data[i][1] != "back")
				$(selector+" tr:eq("+row+") td:eq("+col+")").html("<img src='./img/zhupan_"+data[i][1]+".png'>");
			else
				$(selector+" tr:eq("+row+") td:eq("+col+")").html("<img src='./img/50.png'>");
		}
	}
	function dalu_update(data,selector){   //大路图的更新
		for(var i = 0;i<data.length;i++){
			// var selector = "#tab1003 #tab-default";
			var row = data[i][0] + 11;
			var col = data[i][1];
			// alert(row+"-"+col);
			if(data[i][2][1] != 0 ){
				$(selector+" tr:eq("+row+") td:eq("+col+")").html("<ib>"+data[i][2][1]+"</ib>");
				$(selector+" tr:eq("+row+") td:eq("+col+")").css({"background-image":"url(./img/dalu_"+data[i][2][0]+"_he.png)"});
			}
			else
				$(selector+" tr:eq("+row+") td:eq("+col+")").css({"background-image":"url(./img/dalu_"+data[i][2][0]+".png)"});
		}
	}
	function other_update(data,rowplus,colplus,pic_name,selector){ //其他路图的更新
		// var selector = "#tab1003 #tab-default";
		for(var i = 0;i<data.length;i++){
			var row = rowplus + data[i][0];
			var col = colplus + data[i][1];
			// alert("row:"+row+"col:"+col);
			$(selector + " tr:eq("+row+") td:eq("+col+") img:eq("+data[i][2]+")").attr("src","./img/"+pic_name+"_"+data[i][3]+".png");
		}
	}
	function fill_list(data,selector){//填列表(好像暂时并没有神码用)
		var dalu_data = dalu(data);
		var xiaolu_data = getfill_data(data,1);
		var zhonglu_data = getfill_data(data,2);
		var weilu_data = getfill_data(data,3);
		var dalu_6 = convert6(dalu_data);  //大路填入数据
		//-----------------------填图---------------------------------------------
		fill_img_blank(selector);
		fill_big_blank(selector);
		//**************后三个路图***********************
		fill_img(xiaolu_data,0,6,"dayanzai",selector);
		fill_img(zhonglu_data,0,9,"xiaolu",selector);
		fill_img(weilu_data,17,9,"xiaoqiang",selector);
		//*******************************************

		fill_dalu(dalu_6,0,selector);
		// fill_zhupan(data,selector);
		//-----------------------填图end----------------------------------
		var save = new Array();
		save.push(data,dalu_6,xiaolu_data,zhonglu_data,weilu_data);
		return save;
	}
	function count_judge(data){ //统计庄闲和的个数,返回一个庄闲和的数量的数组
      var z=0,x=0,h=0;//分别代表庄闲和
      var zhuang_dui=0,xian_dui=0;//庄对和闲对
      var rec = new Array();
      for(var i = 0 ;i<data.length;i++){
        var n = judge(data[i]);
        if(n == 1)
          z++;
        if(n == 0)
          h++;
        if(n == -1)
          x++;
      	if(data[i]%2 == 0)
      	  zhuang_dui++;
      	if((data[i]+1)%4 == 0 || data[i]%4==0)
      	  xian_dui++;
      }
      rec.push(z,x,h,zhuang_dui,xian_dui);
      return rec;
    }
    //------------------------time running----------------------------
    function startTime(){//更新时间的控件
		var today=new Date();
		var year = today.getFullYear();
		var month = today.getMonth()+1;
		var date = today.getDate();
		var h=today.getHours();
		var m=today.getMinutes();
		var s=today.getSeconds();
		// add a zero in front of numbers<10
		m=checkTime(m);
		s=checkTime(s);
		$(".an-time").html(year+"/"+month+"/"+date+"  "+h+":"+m+":"+s);
		t=setTimeout(function(){startTime()},500);
	}
	function checkTime(i){
		if (i<10)
		  {
		  i="0" + i;
		  }
		return i;
	}
    //------------------------time end ------------------------------
    //------------------------探路预测-------------------------------
    function diff_tanlu(arr3,arr4){//arr3为旧数据，arr4为新数据
      if (arr4.length > arr3.length)
        return arr4[arr4.length-1][0];
      else{
        var last = arr4.length-1;
        var tmp = arr4[last].length - 1;
        return arr4[last][tmp];
      }
    }
    function tanlu(data,mod1,mod2){ //mod1为探路，庄探路为1,闲探路为0;mod2为路图类型

      var data2 = data.concat();
      var data_old = other(dalu(data),mod2); //老的对应路图数据
      data2.push(mod1);
      // alert(data);
      var data_new = other(dalu(data2),mod2); //新的对应路图数据
      return diff_tanlu(data_old,data_new);
    }
    function tanlu_max(data){ //根据原始数据生成6个探路图

    	var rec = new Array();
    	for(var i = 1;i>=0;i--){
    		for(var j = 1;j<4;j++){
    			var tmp = tanlu(data,i,j);
    			rec.push(tmp);
    		}
    	}

    	return rec;
    }
    //----------------------探路预测end-----------------------------------------
    //------------------------探路预测new-------------------------------
    function tanlu_new(data){
    	var dalu2 = dalu(data);
    	var result = new Array(); //除去和的个数的大路图
    	for(var i = 0;i<dalu2.length;i++){
    		result.push([]);
    		for(var j = 0 ;j<dalu2[i].length;j++){
    			result[i].push(judge(dalu2[i][j][0]));
    		}
    	}
    	// alert(result);
    	var rec = new Array();//用来接受结果的,第一个数组表示庄的预测结果的，第二个表示闲的预测结果
    	var yuce = new Array();//各个预测结果
    	var yuce_reverse = new Array();//预测结果的反推
    	yuce.push(diff_qizheng(result,1));
    	yuce.push(diff_qizheng(result,2));
    	yuce.push(diff_qizheng(result,3));
    	// alert(yuce.length);
    	for(var i = 0;i<yuce.length;i++){
    		yuce_reverse.push(qufan(yuce[i]));
    	}
    	var last = result[result.length-1];
    	// alert(data);
    	var lastlast = last[last.length-1];
    	if(lastlast == -1)
    		rec.push(yuce,yuce_reverse);
    	else
    		rec.push(yuce_reverse,yuce);
    	return rec;
    	

    }
    function diff_qizheng(data,mod){//比较齐整  data表示大路图数组 ;mod 1,2,3分别表示三种小路图
    	var result;

    	var i = data.length-1;
		// for(var j=0;j<data[i].length;j++){
		if(data[i-mod] == undefined)
			return undefined;
		if(data[i-mod].length == data[i].length)
			result = 1;
		else
			result = 0;
		// }
	
		return result;
    }
    function qufan(val){//取反
    	if(val == 1)
    		return 0;
    	if(val == 0)
    		return 1;
    }
    //----------------------探路预测new end------------------------------------------
    function convert_img_array(i,j){//将n×6的数组index 转为n×3×4的数组index
    	var m,n,q;
    	m = parseInt(i/2);
    	n = parseInt(j/2);
    	if(i%2 == 0){
    		if(j%2 == 0)
    			q=0;
    		else
    			q=2;
    	}
    	else{
    		if(j%2 == 0)
    			q=1;
    		else
    			q=3;
    	}
    	var rec = new Array();
    	// alert(n);	
    	rec.push(m,n,q);
    	return rec;
    }
    function update_other_diff(data_old,data_new,mod){//其他三个小路图提取更新 mod 1,2,3分别表示三个小路图
    	// var data2 = data.slice(0,data.length-1);
    	var arr1 = get_xiaolu_6(data_old,mod);
      	var arr2 = get_xiaolu_6(data_new,mod);
      	if(data_new.length > data_old.length)
      		var diff_result= other_diff_3(arr1,arr2);
      	else
      		var diff_result= other_back_diff1(arr1,arr2);
      	var i = diff_result[0];
      	var j = diff_result[1];
    	var nx4 = convert_img_array(i,j);
    	// alert(nx4);
    	var rec = new Array();
    	rec.push(nx4,diff_result[2]);
    	return rec;
    }
    function update_dalu2(data_old,data_new,rowplus,colplus,selector){//大路图的更新2
    	var arr1 = convert6(dalu(data_old));
      	var arr2 = convert6(dalu(data_new));
      	if(data_new.length >= data_old.length)
	      	var diff_result= dalu_diff_3(arr1,arr2);
	    else
	    	var diff_result= dalu_back_diff1(arr1,arr2);
      	var i = diff_result[0];
      	var j = diff_result[1];
    	var row = rowplus+diff_result[0];
    	var col = colplus+diff_result[1];
    	// alert(diff_result);
    	if(diff_result[2] == "back"){
			$(selector+" tr:eq("+row+") td:eq("+col+")").css({"background-image":"url(./img/50.png)"});
			$(selector+" tr:eq("+row+") td:eq("+col+")").html("");
		}
		else{
	    	if(diff_result[2][1] != 0 ){
					$(selector+" tr:eq("+row+") td:eq("+col+")").html("<ib>"+diff_result[2][1]+"</ib>");
					$(selector+" tr:eq("+row+") td:eq("+col+")").css({"background-image":"url(./img/dalu_"+diff_result[2][0]+"_he.png)"});
				}
			else{
					$(selector+" tr:eq("+row+") td:eq("+col+")").css({"background-image":"url(./img/dalu_"+diff_result[2][0]+".png)"});
					$(selector+" tr:eq("+row+") td:eq("+col+")").html("");
    		}
    	}
    }
    function get_xiaolu_6(arr,mod){//从原始数据转换到6×n的数据
      var dalu_data = dalu(arr);
      var xiaolu_data = other(dalu_data,mod);
      return convert6(xiaolu_data);
    }
    function other_diff_3(arr1,arr2){//转换成6×n的数组再进行比较
      var rec = new Array();
      var last2 = arr2[arr2.length - 1];
      if(arr1.length == arr2.length){
        for(var i = 0;i<arr2.length;i++){
          for(var j = 0;j<arr2[i].length;j++){
            if(arr2[i][j] != arr1[i][j] && arr2[i][j] != "none"){
              rec.push(i,j,arr2[i][j]);
            }
          }
        }
      }
      else{
        for(var i = 0;i<last2.length;i++){
          if(last2[i] != "none"){
            rec.push(arr2.length-1,i,last2[i]);
          }
        }
      }
      return rec;
    }
    function dalu_diff_3(arr1,arr2){//大路转换成6×n的数组再进行比较
      var rec = new Array();
      if(arr1.length > arr2.length)
      	var last2 = arr1[arr1.length - 1];
      else 
      	var last2 = arr2[arr2.length-1];
      if(arr1.length == arr2.length){
        for(var i = 0;i<arr2.length;i++){
          for(var j = 0;j<arr2[i].length;j++){
            if(arr2[i][j][0] != arr1[i][j][0] || arr2[i][j][1] != arr1[i][j][1]){
              if(arr2[i][j] == "none")
	            rec.push(i,j,"back");
	          else
	          	rec.push(i,j,arr2[i][j]);
              break;
            }
          }
        }
      }
      else{
        for(var i = 0;i<last2.length;i++){
          if(last2[i] != "none"){
		            rec.push(arr2.length-1,i,last2[i]);
		        }
          }
        }
      return rec;
    }
    function other_update_new(data_old,data_new,rowplus,colplus,pic_name,mod,selector){//selector表示选择器，data为原始数据，mod表示路图类型（1,2,3）
    	var diff_data = update_other_diff(data_old,data_new,mod);
    	var row = rowplus + diff_data[0][0];
    	var col = colplus + diff_data[0][1];
    	if(diff_data[1] == "back")
    		$(selector + " tr:eq("+row+") td:eq("+col+") img:eq("+diff_data[0][2]+")").attr("src","./img/50.png");
    	else
			$(selector + " tr:eq("+row+") td:eq("+col+") img:eq("+diff_data[0][2]+")").attr("src","./img/"+pic_name+"_"+diff_data[1]+".png");
    }
   	function dalu_back_diff1(arr1,arr2){//arr1为旧数据，arr2为新数据,因为是毁棋，所以新数据更短
   	  	var rec = new Array();
   	  	var last1 = arr1[arr1.length - 1];
      	if(arr1.length == arr2.length){
        	for(var i = 0;i<arr2.length;i++){
          		for(var j = 0;j<arr2[i].length;j++){
            		if(arr2[i][j][0] != arr1[i][j][0] || arr2[i][j][1] != arr1[i][j][1]){
              			if(arr2[i][j] == "none")
	           				rec.push(i,j,"back");
	           			else
	           				rec.push(i,j,arr2[i][j]);
            		}
          		}
        	}
     	}
	  	else{
	    	for(var i = 0;i<last1.length;i++){
		      	if(last1[i] != "none"){
			            rec.push(arr1.length-1,i,"back");
			    }
	    	}
    	}
      return rec;
   	}
   	function other_back_diff1(arr1,arr2){//转换成6×n的数组再进行比较
      var rec = new Array();
   	  	var last1 = arr1[arr1.length - 1];
      	if(arr1.length == arr2.length){
        	for(var i = 0;i<arr2.length;i++){
          		for(var j = 0;j<arr2[i].length;j++){
            		if(arr2[i][j] != arr1[i][j]){
              			if(arr2[i][j] == "none")
	           				rec.push(i,j,"back");
	           			else
	           				rec.push(i,j,arr2[i][j]);
            		}
          		}
        	}
     	}
	  	else{
	    	for(var i = 0;i<last1.length;i++){
		      	if(last1[i] != "none"){
			            rec.push(arr1.length-1,i,"back");
			    }
	    	}
    	}
      return rec;
    }
