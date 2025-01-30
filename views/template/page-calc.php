<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


$this->params['breadcrumbs'][] = Page::getTitle();


?>

<style type="text/css">
    .the-calc-top{
        position: relative;
    }
    #calcinput{
        width:100%;
        height:48px;
        padding: 0 15px;
        border:1px solid #d7d7d7;
        border-radius:4px;
        background: #efefef;
        background: -moz-linear-gradient(top, #efefef 0%, #ffffff 100%);
        background: -webkit-linear-gradient(top, #efefef 0%,#ffffff 100%);
        background: linear-gradient(to bottom, #efefef 0%,#ffffff 100%);
        box-sizing: border-box;
        margin-bottom: 0;
    }
    #calcinput:focus{
        border-color:#ffbc01;
        outline:none;
    }
    .calc-variants{
        position: absolute;
        left:0;
        z-index: 500;
        top:50px;
        width:100%;
        border:1px solid #d7d7d7;
        background: #efefef;
        background: -moz-linear-gradient(top, #efefef 0%, #ffffff 100%);
        background: -webkit-linear-gradient(top, #efefef 0%,#ffffff 100%);
        background: linear-gradient(to bottom, #efefef 0%,#ffffff 100%);
        padding: 20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius:4px;
        box-sizing: border-box;
        display: none;
        box-shadow: 0px 16px 30px 0px rgba(0,0,0,.15);
    }
    .calc-variants-close{
        display: block;
        position: absolute;
        height:16px;
        width:16px;
        text-align: center;
        border-radius:100%;
        border:1px solid #cc0000;
        box-sizing: border-box;
        line-height:14px;
        position: absolute;
        font-size:14px;
        right:5px;
        top:5px;
        color:#cc0000;
        cursor:pointer;
    }          
    .calc-variants-close:hover{
        opacity: .5;
    }
    .s-remove{
        display: inline-block;
        height:16px;
        width:16px;
        text-align: center;
        border-radius:100%;
        border:1px solid #cc0000;
        box-sizing: border-box;
        line-height:14px;
        font-size:14px;
        color:#cc0000;
        cursor:pointer;
    }  
    .s-remove:hover{
        opacity: .5;
    }    
    .calc-variants-inner{
        max-height:200px;
        overflow-y:auto;
        
        padding-right: 5px;
    }
    .calc-variants-table{
        width:100%;
        font-size: 14px;
        margin-bottom: 0;
    }
    .calc-variants-table td{
        border-bottom: 1px solid rgba(0,0,0,.08);
        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;
        -o-transition: all 300ms;
        transition: all 300ms;
        padding: 5px 10px;
        color:#333;
        position: relative;
    }
    .calc-variants-table td span{
        text-decoration: underline;
    }
    .calc-variants-table tr td:last-child{
        font-weight: bold;
        white-space:nowrap;
        padding-right: 34px;
        text-align:right;
    }
    .calc-variants-table tr:last-child td{
        border:none;
    }
    .calc-variants-table tr{
        cursor:pointer;
    }
    .calc-variants-table tr:hover td{
        background: #ffbc01;
        border-color:#ffbc01;
        color:#000;
    }
    .calc-variants-table tr:hover td:last-child:after{
        content:'+';
        display: inline-block;
        height:16px;
        width:16px;
        text-align: center;
        border-radius:100%;
        box-sizing: border-box;
        line-height:16px;
        font-weight: bold;
        position: absolute;
        right:5px;
        top:8px;
        color:#000;
    }
    .the-calc-bottom{
        margin-top: 30px;
    }
    .calc-selected{
        border:2px solid #ddd !important;
        width:100%;
        margin-bottom: 30px;
        display: none;
    }
    .calc-selected:hidden{
        margin-bottom: 0px !important;
    }
    .calc-selected tr{
        
    }
    .calc-selected td{
        padding: 5px 10px;
        font-size: 14px;
        vertical-align:middle;
    }
    .calc-selected tr td:nth-child(2){
        white-space: nowrap;
    }
    .calc-selected td i{
        font-size: 12px;
        color:#999;
    }    
    .calc-selected tr td input{
        width:54px;
        padding-top: 0px;
        padding-right: 0;
        padding-bottom: 0px;
        height:30px;
        margin-bottom: 0;
        line-height: 30px;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {  

       opacity: 1;

    }
    .calc-selected tr td:nth-child(3){
        font-weight: bold;
        text-align: right;
        white-space: nowrap;
        min-width: 64px;
    }

    .calc-result{
        text-align:right;
        font-size: 24px;
        
    }
    .calc-result b {
        color:#00aa00;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function($){

        $(".calc-variants-close").click(function(e){
            e.preventDefault();
            $(".calc-variants").hide();
        });

        function getNum(str){
            var numb = str.match(/\d/g);
            numb = numb.join("");
            return numb;
        }

        function showVariants(value){
            if(value.length>2){
                
                var tbl = '';
                for(var i = 0; i < pricetable.length; i++){
                    if(pricetable[i][0].toLowerCase().indexOf(value.toLowerCase()) !== -1){
                        tbl+='<tr><td>'+pricetable[i][0].replace(value,'<span>'+value+'</span>')+'</td><td><i>'+pricetable[i][1]+'</i></td><td>'+pricetable[i][2]+' ₽</td></tr>';
                    }
                }
                if(tbl!=''){
                    $(".calc-variants table").html(tbl);
                    $(".calc-variants").show();
                } else {
                    $(".calc-variants").hide();
                }
            } else {
                $(".calc-variants").hide();
            }
        }

        function recalc(){
            var sum = 0;
            $(".calc-selected tr").each(function(){
                sum+=Number(getNum($(this).find("td").eq(2).text()));
            });
            $(".calc-result b").html(sum);
        }

        $("body").on("click",".calc-variants-table tr",function(e){
            $(".calc-variants").hide();
            var service = $(this).children('td').eq(0).text();
            var ed = $(this).children('td').eq(1).text();
            var price = getNum($(this).children('td').eq(2).text());
            $(".calc-selected").append('<tr><td>'+service+'</td><td><input min="1" data-orig="'+price+'" class="q" type="number" value="1">&nbsp;&nbsp;<i>'+ed+'</i></td><td>'+price+' ₽</td><td><div class="s-remove">x</div></tr>');
            $(".calc-selected").show();
            recalc();
        })

        $("body").on("click",".s-remove",function(){
            $(this).parents("tr").remove();
            if ($(".calc-selected").find('tr').length==0){
                $(".calc-selected").hide();
            }
            recalc();
        })

        $("body").on("input",".q",function(){
            var pr = $(this).data("orig")*$(this).val();
            $(this).parents("tr").find("td").eq(2).html(pr+ ' ₽');
            recalc();
        });

        $("#calcinput").keyup(function(){
            showVariants($(this).val());
        })

        $("#calcinput").click(function(){
            showVariants($(this).val());
        })

    })
</script>

<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>

<div class="container content">
    <div class="row">
        
        <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['sidebar_visible'])): ?>
            <div class="three-mod columns">
                <?php require_once __DIR__.'/../layouts/include/sidebar.php'; ?>
            </div>
            <div class="nine-mod columns">
        <?php else: ?>
            <div class="twelve columns">
        <?php endif; ?>

        <?php require_once __DIR__.'/../layouts/include/breadcrumbs.php'; ?>

        <?php 
            $pageTitle = Page::getTitle();
            $pageContent = Page::getContent();
        ?>

        <?php if (!empty($pageTitle)): ?>
            <h1><?= CustomHelper::custom_br($pageTitle) ?></h1>
        <?php endif; ?>

        <?php if (!empty($pageContent)): ?>
            <div><?= $pageContent ?></div>
        <?php endif; ?>


        <?php

            function tdrows($elements)
            {
                $str = "";
                $td = false;
                foreach ($elements as $element) {
                    if($element->nodeName=='td'){
                        $str .= $element->nodeValue . "|";
                        $td = true;
                    }

                }
                if($td){
                    return substr($str,0,-1);
                } else {
                    return false;
                }
            }

            echo "<script>";
            echo "var pricetable = [";

            $contents = '<?xml encoding="utf-8" ?>'.Yii::$app->params['page']['table'];

            $DOM = new DOMDocument;
            $DOM->loadHTML($contents);

            $items = $DOM->getElementsByTagName('tr');

            foreach ($items as $node) {
                $row = tdrows($node->childNodes);
                if($row!==false){
                    $vals = explode("|",$row);
                    echo "['".$vals[0]."','".$vals[1]."',"."'".$vals[2]."'],";
                }
            }

            echo "];";
            echo "</script>";

        ?>


        <div class="the-calc" style="margin-bottom:25px">
            <div class="the-calc-top">
                <input id="calcinput" type="" name="" placeholder="Начните вводить название услуги (напр., установка раковин)">
                <div class="calc-variants">
                    <div class="calc-variants-close">x</div>
                    <div class="calc-variants-inner">
                        <table class="calc-variants-table"></table>
                    </div>
                </div>
            </div>
            <div class="the-calc-bottom">
                <table class="calc-selected">
                </table>
                <div class="calc-result">
                    <b>0</b> ₽
                </div>
            </div>
        </div>

        <div>
            <?= Yii::$app->params['page']['after_table'] ?>
        </div>

        </div>
    </div>
</div>
