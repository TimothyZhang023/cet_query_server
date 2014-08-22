<?php
error_reporting(0);

$arr_1 = array("218","218","22","66","218","218","129","54"
,"202","204","70","62","67","59","61","69","222","221"
,"100","3","53","60","40","218","217","62","63"
,"64","199","62","122","211"); 
$randarr1= mt_rand(0,count($arr_1)-1); 
$randarr2= mt_rand(0,count($arr_1)-1); 
$randarr3= mt_rand(0,count($arr_1)-1); 
$randarr4= mt_rand(0,count($arr_1)-1);  
$ip1id = $arr_1[$randarr1].".". $arr_1[$randarr2].".". $arr_1[$randarr3].".". $arr_1[$randarr4];


function filter($in){

 $out =strip_tags($in);
 $out = str_replace(array("\r\n", "\r", "\n", "\t"), "", $out);
  return $out;
}

$header = array( 
	'CLIENT-IP:'.$ip1id, 
	'X-FORWARDED-FOR:'.$ip1id, 
); 

$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9';
$referer="http://www.chsi.com.cn/cet/";
$zkzh=$_GET['id'];
$xm=$_GET['name'];
 
$ch = curl_init();
//设置URL

curl_setopt($ch, CURLOPT_URL,"http://www.chsi.com.cn/cet/query?zkzh=".$zkzh."&xm=".$xm);
//设置user_agent
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);	
//设置referer
curl_setopt($ch, CURLOPT_REFERER, $referer);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
//成功时返回结果
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//设置超时30秒
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// 显示返回的Header区域内容
curl_setopt($ch, CURLOPT_HEADER, 0); 
// 显示重定向
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//设置POST及POST数组
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//执行并获取HTML文档内容
$output = curl_exec($ch);
//获取执行信息
$info = curl_getinfo($ch);
$error=curl_error($ch);
//释放curl句柄
curl_close($ch);

if($error===''){$error="None";}

//echo $output;
//echo '<br />获取'. $info['url'] . '耗时'. $info['total_time'] . "秒<br />";
//echo "<br />错误：$error<br />";

preg_match_all('/\<td\>([^<>]+)<\/td>/', $output, $user_info);

if($user_info['0']['3']==""){
	$res=array(
		"status"=>0,
		"msg"=>"姓名或者准考证号错误",
	);
	die(json_encode($res));
}
preg_match('/\<span class\=\"colorRed\"\>([^<>]+)\<\/span\>/', $output, $score_sum);


preg_match_all('/\t\d+/', $output, $user_grade);	


/*
echo "总分：".$score_sum[0]."<br />";

echo "姓名：".$user_info[0][0]."<br />";
echo "学校：".$user_info[0][1]."<br />";
echo "考试：".$user_info[0][2]."<br />";
echo "准考证号：".$user_info[0][3]."<br />";
echo "时间：".$user_info[0][4]."<br />";
	

echo '<br />
<strong><span style="color: #F00;">总分：'.$score_sum[0].'</span><br />
<span >听力：</span>'.$user_grade[0][1].'<br />
<span >阅读：</span>'.$user_grade[0][2].'<br />
<span >综合：</span>'.$user_grade[0][3].'<br />
<span >写作与翻译：</span>'.$user_grade[0][4].'</strong><br />
';
*/

$res=array(
		"status"=>1,
		"msg"=>"ok",
		"user"=>array(
			"name"=>filter($user_info[0][0]),
			"school"=>filter($user_info[0][1] ),
			"cat"=>filter($user_info[0][2]),
			"zkzh"=>filter($user_info[0][3] ),
			"time"=>filter($user_info[0][4] ),
		
		),
		"sum"=>filter($score_sum['0']),
		"score"=>array(
			"sum"=>filter($score_sum[0]),
		 "listen"=>filter($user_grade[0][1]),
		 "reading"=>filter($user_grade[0][2]),
		 "writing"=>filter($user_grade[0][3]),
		 
		
		)
	);
	
	
preg_match_all('/<\/span>([^<>]+)<br><span/', $output, $user_grade);	





die(json_encode($res));
 

?>