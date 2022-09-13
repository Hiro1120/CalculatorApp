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
        case 'AC': //オールクリア
            $displayNum = '';
            $pre_num = '';
            $input_num = '';
            break;

        case '+/-': //符号反転
            $displayNum = -$displayNum;
            break;

        case '%': //百分率
            $displayNum = $displayNum / 100;
            break;

        case 'x^2': //二乗
            $displayNum *= $displayNum;
            break;

        case 'e': //ネイピア数
            $displayNum = $displayNum * 2.718281828459045;
            break;    

        case 'e^x': //ネイピア数の累乗
            $displayNum = 2.718281828459045 ** $displayNum;
            break;

        case '10^x': //10の累乗
            $displayNum = 10 ** $displayNum;
            break;
            default: //次の処理へ

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

                case 'x^y':
                    $displayNum = $pre_num ** $displayNum;
                    break;
                    default:
                    break;
            }

            //現在入力中の値をクリア
            if($button == "C"){
                $displayNum = $pre_num;
                $ope = '';
                $pre_button = $pre_num;
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
    if($btn=='+'||$btn=='-'||$btn=='×'||$btn=='÷'||$btn=='AC'||$btn=='C'||$btn=='x^2'||$btn=='%'||$btn=='+/-'||$btn=='e'||$btn=='e^x'||$btn=='x^y'||$btn=='10^x'){
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

