<?php
error_reporting(E_ALL ^ E_NOTICE);
echo '<h1>******</h1>';
function aveCard(){
    $url = ''; // 接口
	$data = array(
                'encode'=>'json'
            );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 6);
    $response = curl_exec($ch);
    if($error=curl_error($ch)){
        return '可恶，竟然失败了，F5刷新再试一下吧...'; // 接口调用失败则输出这个默认句子~
    }
    curl_close($ch);
    $array_data = json_decode($response,true);
	echo '<table border="2" style="width: 50%;border-collapse: collapse;border-spacing: 0;"><tr><th>名字</th><th>平均</th><th>最大</th><th>最小</th><th>实时</th>
	<tr><td width="10%">'.$array_data[listData][data][0]['name'].'</td><td width="10%">'.array_sum($array_data[listData][data][0]['history']) / count($array_data[listData][data][0]['history']).'</td><td width="10%">'.max($array_data[listData][data][0]['history']).'</td><td width="10%">'.min($array_data[listData][data][0]['history']).'</td><td width="10%">'.$array_data[listData][data][0]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][1]['name'].'</td><td>'.array_sum($array_data[listData][data][1]['history']) / count($array_data[listData][data][1]['history']).'</td><td>'.max($array_data[listData][data][1]['history']).'</td><td>'.min($array_data[listData][data][1]['history']).'</td><td>'.$array_data[listData][data][1]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][2]['name'].'</td><td>'.array_sum($array_data[listData][data][2]['history']) / count($array_data[listData][data][2]['history']).'</td><td>'.max($array_data[listData][data][2]['history']).'</td><td>'.min($array_data[listData][data][2]['history']).'</td><td>'.$array_data[listData][data][2]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][3]['name'].'</td><td>'.array_sum($array_data[listData][data][3]['history']) / count($array_data[listData][data][3]['history']).'</td><td>'.max($array_data[listData][data][3]['history']).'</td><td>'.min($array_data[listData][data][3]['history']).'</td><td>'.$array_data[listData][data][3]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][4]['name'].'</td><td>'.array_sum($array_data[listData][data][4]['history']) / count($array_data[listData][data][4]['history']).'</td><td>'.max($array_data[listData][data][4]['history']).'</td><td>'.min($array_data[listData][data][4]['history']).'</td><td>'.$array_data[listData][data][4]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][5]['name'].'</td><td>'.array_sum($array_data[listData][data][5]['history']) / count($array_data[listData][data][5]['history']).'</td><td>'.max($array_data[listData][data][5]['history']).'</td><td>'.min($array_data[listData][data][5]['history']).'</td><td>'.$array_data[listData][data][5]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][6]['name'].'</td><td>'.array_sum($array_data[listData][data][6]['history']) / count($array_data[listData][data][6]['history']).'</td><td>'.max($array_data[listData][data][6]['history']).'</td><td>'.min($array_data[listData][data][6]['history']).'</td><td>'.$array_data[listData][data][6]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][7]['name'].'</td><td>'.array_sum($array_data[listData][data][7]['history']) / count($array_data[listData][data][7]['history']).'</td><td>'.max($array_data[listData][data][7]['history']).'</td><td>'.min($array_data[listData][data][7]['history']).'</td><td>'.$array_data[listData][data][7]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][8]['name'].'</td><td>'.array_sum($array_data[listData][data][8]['history']) / count($array_data[listData][data][8]['history']).'</td><td>'.max($array_data[listData][data][8]['history']).'</td><td>'.min($array_data[listData][data][8]['history']).'</td><td>'.$array_data[listData][data][8]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][9]['name'].'</td><td>'.array_sum($array_data[listData][data][9]['history']) / count($array_data[listData][data][9]['history']).'</td><td>'.max($array_data[listData][data][9]['history']).'</td><td>'.min($array_data[listData][data][9]['history']).'</td><td>'.$array_data[listData][data][9]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][10]['name'].'</td><td>'.array_sum($array_data[listData][data][10]['history']) / count($array_data[listData][data][10]['history']).'</td><td>'.max($array_data[listData][data][10]['history']).'</td><td>'.min($array_data[listData][data][10]['history']).'</td><td>'.$array_data[listData][data][10]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][11]['name'].'</td><td>'.array_sum($array_data[listData][data][11]['history']) / count($array_data[listData][data][11]['history']).'</td><td>'.max($array_data[listData][data][11]['history']).'</td><td>'.min($array_data[listData][data][11]['history']).'</td><td>'.$array_data[listData][data][11]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][12]['name'].'</td><td>'.array_sum($array_data[listData][data][12]['history']) / count($array_data[listData][data][12]['history']).'</td><td>'.max($array_data[listData][data][12]['history']).'</td><td>'.min($array_data[listData][data][12]['history']).'</td><td>'.$array_data[listData][data][12]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][13]['name'].'</td><td>'.array_sum($array_data[listData][data][13]['history']) / count($array_data[listData][data][13]['history']).'</td><td>'.max($array_data[listData][data][13]['history']).'</td><td>'.min($array_data[listData][data][13]['history']).'</td><td>'.$array_data[listData][data][13]['price'].'</td></tr>
	<tr><td>'.$array_data[listData][data][14]['name'].'</td><td>'.array_sum($array_data[listData][data][14]['history']) / count($array_data[listData][data][14]['history']).'</td><td>'.max($array_data[listData][data][14]['history']).'</td><td>'.min($array_data[listData][data][14]['history']).'</td><td>'.$array_data[listData][data][14]['price'].'</td></tr>
	</tr></table>';
   //return $card_content;
}
echo aveCard();
?>