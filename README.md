# EyeKey
// demo
$face = new eyekey();
$info = $face->execute('/face/Check/checking',array(
    'url'=>'http://img5q.duitang.com/uploads/item/201307/07/20130707215045_SJyRn.jpeg',
    'mode'=>'',
    'tip'=>''
    ));
echo '<pre>';
print_r($info);
