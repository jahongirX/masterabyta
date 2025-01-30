<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\Setting;


$recaptchaV3Helper = new \app\helpers\RecaptchaV3Helper();
$recaptchaPublicKey = $recaptchaV3Helper->getPublicKey();

?>

<script>
$(document).on('submit', '.header__search-form', function(e){
  if ($(this).find('input[name="s"]').val().length < 3) {
    alert('Минимум 3 символа');
    return false;
  }
});
var customsendform_block = 0;
var recaptcha_public_key = '<?= $recaptchaPublicKey ?>';


// валидация форм
setTimeout(function(){
  $('.form-validator').validator({
    'focus' : false
  });
}, 250);


function send_form(form) {
  var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
  var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

  var data = form.serialize();
  data = data + '&' + csrf_name + '=' + csrf_value;

  if (typeof post_id !== 'undefined' && post_id) {
    data = data + '&page=' + post_id;
  }
  if (typeof page_url !== 'undefined' && page_url) {
    data = data + '&page-url=' + page_url;
  }

  $.ajax({
    url: '/send-validate/',
    type: 'POST',
    data: data,
    success: function(res){
      if(res === 'ok'){

        var modal_success_show = 0;
        form.find('input.form-control, textarea.form-control').val('');
        if ($('.modal:visible').length > 0) {
          $('.modal:visible').modal('hide');
        } else {
          $('#modal-thx').modal('show');
          modal_success_show = 1;
        }

        $.ajax({
          url: '/send-confirm/',
          type: 'POST',
          data: data,
          success: function(res){
            // console.log(res);
          }
        });

        setTimeout(function(){
          if (modal_success_show == 0) {
            $('#modal-thx').modal('show');
          }
          // отправляем цель в яндекс метрике
          if (typeof ym === 'function') {
            // получаем id счетчиков, подключенных к странице
            var yandexMetrikaCounters = window.Ya._metrika.counters;
            for (var key in yandexMetrikaCounters) {
              if (yandexMetrikaCounters.hasOwnProperty(key)) {
                  var yandexMetrikaId = key.split(':');
                  if (yandexMetrikaId[0] !== 'undefined') {
                    ym(yandexMetrikaId[0], 'reachGoal', 'LEADBACK_CALL');
                  }
              }
            }
          }

          setTimeout(function(){
            if($('#modal-thx').css('display') !== 'none'){
              $('#modal-thx').modal('hide');
            }
          }, 3000);
        }, 500);

      }else if(res === 'error'){

        $('#modal-error .modal-error__title').html('Ошибка');
        $('#modal-error .modal-error__text').html('Не удалось отправить сообщение');
        $('#modal-error').modal('show');
        setTimeout(function(){
          if($('#modal-thx').css('display') !== 'none'){
            $('#modal-thx').modal('hide');
          }
        }, 3000);

      }else if(res === 'captcha'){

        $('#modal-error .modal-error__title').html('Ошибка');
        $('#modal-error .modal-error__text').html('Подтвердите что вы не робот');
        $('#modal-error').modal('show');
        setTimeout(function(){
          if($('#modal-thx').css('display') !== 'none'){
            $('#modal-thx').modal('hide');
          }
        }, 3000);

      }
      customsendform_block = 0;
    },
    error: function(res){
      customsendform_block = 0;
    }
  });
}


$(document).on('submit', '.custom-send-form', function(e){
  e.preventDefault();
  if ($(this).find('button.disabled[type="submit"]').length > 0) {
    return false;
  }
  if(customsendform_block === 1) return false;
  customsendform_block = 1;

  var form = $(this);

  if (recaptcha_public_key) {
    grecaptcha.ready(function() {
      grecaptcha.execute(recaptcha_public_key, {action: 'send'}).then(function(token) {
        if (form.find('input[name="g-recaptcha-response"]').length == 0) {
          form.append('<input type="hidden" class="hidden" name="g-recaptcha-response">');
        }
        form.find('input[name="g-recaptcha-response"]').val(token);
        send_form(form);
      });
    });
  } else {
    send_form(form);
  }
  
return false;
});
</script>






<script>
$(document).ready(function(){
  if ($(".price-oglav p").length > 0) {
    let x = 0,oglav_hidden = false;
    $(".price-oglav p").each(function(){
      x++;
      if(x>14){
        $(this).addClass("tohide hidden");
        oglav_hidden = true;
      }
    });


    if(oglav_hidden){
      $('<div class="price-toggler"><span>Показать все</span> <i class="fa fa-angle-down"></i></div>').appendTo($(".price-oglav"));
    }

    $("body").on("click",".price-oglav .price-toggler",function(){
    $(this).parent().find(".tohide").toggleClass("hidden");
      
    });
  }
})
</script>