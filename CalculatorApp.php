<?php
//------------------------変数の定義-------------------------

$displayNum = $_POST['displayNum']; //ディスプレイに表示されている数字
$pre_num = $_POST['pre_num']; //1つ前の数字
$ope = $_POST['ope']; //記号
$pre_button = $_POST['pre_button']; //1つ前のボタン
$button = $_POST['button']; //ボタン
$input_num = $_POST['input_num']; //追加する数字

//----------------------------------------------------------

//------------------------処理の内容--------------------------

//＜＜＜＜＜＜＜＜＜＜＜＜数字ボタンが押された場合＞＞＞＞＞＞＞＞＞＞＞＞＞
if(isNumBtn($button)||empty($button)){
    //次に記号を押した場合
    if(isSymBtn($pre_button)){
        $pre_num = $displayNum;
        $displayNum = $button; //次に押した数字が表示される
    }else{ //連続で数字が押された場合
            
            //01や02と表示されないようにする
            if(($displayNum == '0') && (isNumBtn($button) != '0')){ 
                $displayNum = '';
            }
            //00と表示されないようにする
            if(($displayNum == '0') && ($button == '0')){
                $displayNum = '';
            }
            $displayNum = $displayNum.$button;
    }


}else{

//＜＜＜＜＜＜＜＜＜＜＜＜記号ボタンが押された場合＞＞＞＞＞＞＞＞＞＞＞＞＞＞
    switch($button){
        case 'C': //クリアを押した場合
            $displayNum = '';
            $pre_num = '';
            $input_num = '';
            break;

        case 'AC':
            $displayNum = '';
            $pre_num = '';
            $input_num = '';
            break;
            default: //クリアを押さなかったら次の処理へ

            //すでに数字ボタンが押されており、次に押すボタンが記号ボタンまたは「=」の場合
        if(!empty($pre_num)&&(preg_match('/=/', $button)||(isNumBtn($pre_button)&&isSymBtn($button)))){
            switch($ope){
                case '+':
                    $displayNum = $pre_num + $displayNum;
                    break;
                case '-':
                    $displayNum = $pre_num - $displayNum;
                    break;
                case '×':
                    $displayNum = $pre_num * $displayNum;
                    break;
                case '÷':
                    $displayNum = $pre_num / $displayNum;
                    break;
                case '%':
                    $displayNum = $pre_num / 100;
                    break;                    
                    default:
                    break;
            }
        }
        //「=」を押さない場合
        if ($button != '＝'){
            $ope = $button;  
        }      
    break;
    }
}
//押したボタンの数字を表示
$pre_button = $button;
//----------------------------------------------------------

//------------------------関数の定義--------------------------

//記号ボタンの判別に関する関数
function isSymBtn($btn){
    if($btn=='+'||$btn=='-'||$btn=='×'||$btn=='÷'||$btn=='AC'||$btn=='C'||$btn=='.'||$btn==' '||$btn=='%'){
        return true;
    }else{
        return false;
    }
}

//数字ボタンの判別に関する関数
function isNumBtn($btn){
    if($btn=='1'||$btn=='2'||$btn=='3'||$btn=='4'||$btn=='5'||$btn=='6'||$btn=='7'||$btn=='8'||$btn=='9'){
        return true;
    }else{
        return false;
    }
}

//----------------------------------------------------------
?>

