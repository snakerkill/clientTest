var xmlHttp = GetXmlHttpObject();
//保存将要传递的post_fields
var post_fields_param = {};
//保存将要传递的jsonArgs
var jsonArgs_param = {};
//请求参数返回的结果
var result;
//请求参数易读
var resutlEasy;
if (xmlHttp==null)
{
	alert ("Browser does not support HTTP Request");
} 
function getUserInfo(){
	//var LoginName = encodeURIComponent(document.getElementById("LoginName").value);
	var LoginName = document.getElementById("LoginName").value;
	var password = document.getElementById("password").value;
	var environment = document.getElementById("user_environment").value;
	//console.log(LoginName);
	//console.log(password);
	xmlHttp.onreadystatechange=showUser;
	var url = "http://www.ganji.com/clientTest.php"; 
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	var SendData = 'action=user'+
				'&LoginName='+LoginName+
				'&password='+password+
				'&environment='+environment;
	console.log(SendData);
	xmlHttp.send(SendData);
}
function showUser(){
	if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		console.log(xmlHttp.responseText);
		eval("var json = " + xmlHttp.responseText);
		console.log(json);
		var LoginName = document.getElementById("username");
		LoginName.innerHTML = json.LoginName;
		var user_id = document.getElementById("user_id");
		user_id.innerHTML = json.LoginId;
		var user_environmentshow = document.getElementById("user_environmentshow");
		user_environmentshow.innerHTML = json.environment;
	}
}
function showInterfaceInfo(){
	if(xmlHttp.readyState == 4 || xmlHttp.readyState == 'complete')
	{
		jsonArgs_param = new Array();
		post_fields_param = new Array();
		eval("var json = " + xmlHttp.responseText);
		console.log(json);
		var interface_info = document.getElementById('interface_info');
		var info = "";
		if(json.message[0] != undefined)
		info = json.message[0];
		if(json.message[1] != undefined)
		info += json.message[1];
		interface_info.innerHTML = info;
		console.log(interface_info.innerHTML);
		var header = "";
		for(var item in json.header){
			header += "<input type='text' name='header[]' size='40' value='"+json.header[item]+"'/>"
			if(item % 2 == 1) header += "<br/>";
		}
		header_content = document.getElementById('header_content');
		header_content.innerHTML = '';
		var post_fields_content = document.getElementById('post_fields_content');
		post_fields_content.innerHTML = '';
		var jsonArgs_content = document.getElementById('jsonArgs_content');
		jsonArgs_content.innerHTML = '';
		header_content.innerHTML = header;
		if(json.jsonArgs != ""){
			var jsonArgs = "<table id='jsonArgsT'>";
			for(var item in json.jsonArgs){
				jsonArgs_param[item] = json.jsonArgs[item];
				jsonArgs += "<tr><td><label>"+item+"</label></td><td><input type='text' name='jsonArgs["+item+"]'value='"+
				json.jsonArgs[item]+"' onblur='changeValue();'/></td></tr>";
			}
			jsonArgs += "</table><table><tr><td>添加参数name</td><td>添加参数value</td></tr>"+
							   "<tr><td><input type='text' id='new_jsonArgs_name'/></td>" + 
						       "<td><input type='text' id='new_jsonArgs_value'/></td>"  +
				               "<td><a class='button' onclick='addJsonArgs();'>添加新参数</a></td></tr></table>";
			jsonArgs_content.innerHTML = jsonArgs;
		}
		if(json.post_fields != ""){
			var post_fields = "<table id='post_fieldsT'>";
			for(var item in json.post_fields){
				console.log(item);
				post_fields_param[item] = json.post_fields[item];
				post_fields += "<tr><td><label>"+item+"</label></td><td><input type='text' name='post_fields["+item+"]'value='"
						 +json.post_fields[item]+"' onblur='changeValue();'/></td></tr>";
			}
			post_fields += "</table><table><tr><td>添加参数name</td><td>添加参数value</td></tr>"+
							   "<tr><td><input type='text' id='new_post_fields_name'/></td>" + 
						       "<td><input type='text' id='new_post_fields_value'/></td></tr></table><nobr/>"  +
				               "<a class='button' onclick='addPost_fields'>添加新参数</a>";
			post_fields_content.innerHTML = post_fields;
		}
	}
}
function getInterfaceInfo(){
	var request_interface = document.getElementById("interface").value;
	xmlHttp.onreadystatechange = showInterfaceInfo;
	var url = "http://www.ganji.com/clientTest.php";
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	var SendData = 'action=getInfo'+
				   '&interface='+request_interface;
	console.log(SendData);
	xmlHttp.send(SendData);
}
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
   		{
 			// Firefox, Opera 8.0+, Safari
 			xmlHttp=new XMLHttpRequest();
   		}
	catch (e)
		{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		}
	return xmlHttp;
}
function addJsonArgs(){
	var new_jsonArgs_name = document.getElementById('new_jsonArgs_name');
	var new_jsonArgs_value = document.getElementById('new_jsonArgs_value');
	var jsonArgs = document.getElementById('jsonArgsT');
	var tr = document.createElement('tr');
	var td1 = document.createElement('td');
	var td2 = document.createElement('td');
	td1.innerHTML = "<label>"+new_jsonArgs_name.value+"</label>";
	td2.innerHTML = "<input name=jsonArgs['"+new_jsonArgs_name.value+"'] " +
					"value="+new_jsonArgs_value.value+" onblur='changeValue();'/>";
	jsonArgs_param[new_jsonArgs_name.value] = new_jsonArgs_value.value;
	tr.appendChild(td1);
	tr.appendChild(td2);
	jsonArgs.appendChild(tr);
	new_jsonArgs_name.value = "";
	new_jsonArgs_value.value = "";
}
function addPost_fields(){
	var new_post_fields_name = document.getElementById('new_post_fields_name');
	var new_post_fields_value = document.getElementById('new_post_fields_value');
	var post_fields = document.getElementById('post_fieldsT');
	var tr = document.createElement('tr');
	var td1 = document.createElement('td');
	var td2 = document.createElement('td');
	td1.innerHTML = "<label>"+new_post_fields_name.value+"</label>";
	td2.innerHTML = "<input name=jsonArgs['"+new_post_fields_name.value+"'] " +
					"value="+new_post_fields_value.value+" onblur='changeValue();'/>";
	post_fields_param[new_post_fields_name.value] = new_post_fields_value.value;
	tr.appendChild(td1);
	tr.appendChild(td2);
	post_fields.appendChild(tr);
	new_post_fields_name.value = "";
	new_post_fields_value.value = "";
}
function request(){
	if(document.getElementById('header_content').innerHTML == ""){
		alert("请先选择调用接口!!");
		return false;
	}
	var headerInput = document.getElementsByName('header[]');
	var header = new Array();
	var environment = document.getElementById('environment').value;
	//console.log(headerInput.length);
	for(var input in headerInput){
		if(input != 'length' && input != 'item')
		header[input] = headerInput[input].value;
	}
	console.log(header);
	xmlHttp.onreadystatechange=showResult;
	var url = "http://www.ganji.com/clientTest.php"; 
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	console.log(arrTojson(header));
	console.log(arrTojson(jsonArgs_param));
	var SendData = 'action=simulate'+
				'&environment='+ environment +
				'&header='+ encodeURIComponent(arrTojson(header)) +
				'&jsonArgs='+ encodeURIComponent(arrTojson(jsonArgs_param)) +
				'&post='+ encodeURIComponent(arrTojson(post_fields_param));
	console.log(SendData);
	xmlHttp.send(SendData);
}
function showResult(){
	if(xmlHttp.readyState == 4 || xmlHttp.readyState == 'complete')
	{
		result = xmlHttp.responseText;
		console.log(result);
		eval("window.resultEasy = " + xmlHttp.responseText);	
		var resultShow = document.getElementById('result');
		var re1 = /,/g;
		var re2 = /(\\r\\n)|(\\n)/g; 
		window.resultEasy = JSON.stringify(resultEasy).replace(re1,',\n').replace(re2,'\n');  
		resultShow.value = resultEasy;
	}
}
function arrTojson(arr){
	if(arr == 'undefined') return "";
	var jsonstr;
	var flag = true;
	//区分关联数组和普通数组
	var method;
	for(var i in arr){
		if(flag){
			flag = false;
			if(isInt(i)){
				method = 2;	
				jsonstr="[";
			}
			else{
				method = 1;
				jsonstr="{";
			}
		}
		if(method == 1 && i != length)
		    jsonstr += "\"" + i + "\""+ ":" + "\"" + arr[i] + "\",";
		if(method == 2)
			jsonstr += "\"" + arr[i] + "\",";
		}
		if(flag)
		return "";
		jsonstr = jsonstr.substring(0,jsonstr.lastIndexOf(','));
		if(method == 1)
		jsonstr += "}";
		if(method == 2)
		jsonstr += "]";
		return jsonstr;
}
function isInt(str){
	var reg = /^\d+$/ ;
	return reg.test(str);
}
function showAsJson(){
	var asjson = document.getElementById('asjson');
	var asjsonEasy = document.getElementById('asjsonEasy');
	asjson.className = "select";
	asjsonEasy.className = "unselect";
	var resultShow = document.getElementById('result');
	resultShow.value = result;
}
function showAsJsonEasy(){
	var asjson = document.getElementById('asjson');
	var asjsonEasy = document.getElementById('asjsonEasy');
	asjson.className = "unselect";
	asjsonEasy.className = "select";
	var resultShow = document.getElementById('result');
	resultShow.value = resultEasy;
}
function changeValue(event){
	var e = event || window.event;	
	var target = (e.target)?e.target:e.srcElement;	
	var reg = /^jsonArgs/ ;
	var flag = 0;
	console.log(target.name);
	var name = target.name.split("[");
	var name = name[1].replace(']','');
	console.log(name);
	if(reg.test(target.name))
		flag = 1;
	if(flag ==0 ){
		post_fields_param[name] = target.value;
	}
	else
		jsonArgs_param[name] = target.value;
}
