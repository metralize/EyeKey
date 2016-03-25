# EyeKey
// demo</br>
$face = new eyekey();</br>
$info = $face->execute('/face/Check/checking',array(</br>
    'url'=>'http://img5q.duitang.com/uploads/item/201307/07/20130707215045_SJyRn.jpeg',</br>
    'mode'=>'',</br>
    'tip'=>''</br>
    ));</br>
echo '<pre>';</br>
print_r($info);</br>
