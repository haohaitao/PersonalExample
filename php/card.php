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
	<tr><td width="10%">$array_data[name]</td><td width="10%">$array_data[name]</td>
	<td width="10%">$array_data[name]</td><td width="10%">$array_data[name]</td><td width="10%">$array_data[name]</td></tr>
	<tr><td>$array_data</td><td>$array_data</td><td>$array_data</td><td>$array_data</td><td>$array_data</td></tr></tr></table>';
   //return $card_content;
}
echo aveCard();
?>