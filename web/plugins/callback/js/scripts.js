// цвет кнопки
var custom_callback_btn_color = '#E67E22';
// текст подсказки
var custom_callback_tooltip_text = 'Акция: скидка до 20% при заказе. Закажите звонок сейчас и закрепите скидку!';
// таймер появления подсказки, сек
var custom_callback_tooltip_timer = 15;
// таймер открытия окна, сек
var custom_callback_modal_timer = 45;

// цвет кнопок в окне
var custom_callback_modal_btn_color = '#ffc501';
// заголовок в окне
var custom_callback_modal_title = 'Здравствуйте, оставьте Ваш телефон!<br>Оператор перезвонит в течение 5 минут!';
// подзаголовок в окне
var custom_callback_modal_subtitle = 'Сделаем все качественно! При заказе с сайта скидка до 15%!';
// текст на кнопке формы в окне
var custom_callback_modal_form_btn = 'Оставить заявку';
// текст согласия на обработку данных
var custom_callback_modal_agreement_text = 'Нажимая «Оставить заявку», вы принимаете условия <a target="_blank" rel="noopener noreferrer nofollow" href="/soglasie/" class="nobr">Согласия</a> и <a target="_blank" rel="noopener noreferrer nofollow" href="/privacy-policy/">Политики конфи&shy;ден&shy;циаль&shy;ности</a>';
// адрес файла обработчика формы
var custom_callback_modal_form_action = '/send/';

// заголовок в окне после отправки формы
var custom_callback_modal_answer_title = 'Спасибо!';
// подзаголовок в окне после отправки формы
var custom_callback_modal_answer_subtitle = 'Сейчас наш менеджер позвонит вам.';
// текст на кнопке в окне после отправки формы
var custom_callback_modal_answer_btn = 'Закрыть';
// цель яндекс метрики при отправке формы
var custom_callback_modal_metrika_target = 'LEADBACK_CALL';




// домен
var custom_callback_domain = '';
if (typeof window.location.hostname === 'string') {
  var custom_callback_hostname = window.location.hostname;
} else if (typeof window.location.host === 'string') {
  var custom_callback_hostname = window.location.host;
}
custom_callback_hostname = custom_callback_hostname.split('.');
custom_callback_hostname = custom_callback_hostname.slice(-2);
custom_callback_hostname = custom_callback_hostname.join('.');
if (custom_callback_hostname) {
  custom_callback_domain = custom_callback_hostname;
}



/** 
 * Получаем код кнопки
 */
function get_custom_callback_btn() {
  var html = '';
  html += '<div class="custom-callback">';
  html += ' <a role="button" class="custom-callback__btn">';
  html += '   <span class="custom-callback__btn-wave"></span>';
  html += ' </a>';
  if (typeof custom_callback_tooltip_text !== 'undefined' && custom_callback_tooltip_text) {
    html += ' <div class="custom-callback__tooltip">';
    html += '   <div class="custom-callback__tooltip-text">'+custom_callback_tooltip_text+'</div>';
    html += ' </div>';
  }
  html += '</div>';
  return html;
}

/**
 * Получаем код окна
 */
function get_custom_callback_modal() {
  var html = '';
  html += '<div class="custom-callback-modal">';
  html += '  <div class="custom-callback-modal__container">';
  html += '    <div class="custom-callback-modal__content">';
  html += '      <a role="button" class="custom-callback-modal__close-btn">';
  html += '          <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjE3cHgiIGhlaWdodD0iMTdweCIgdmlld0JveD0iMCAwIDE3IDE3IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0MS4yICgzNTM5NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+aWNfY2FuY2VsPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGRlZnM+PC9kZWZzPgogICAgPGcgaWQ9Ikljb25zIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBzdHJva2UtbGluZWNhcD0icm91bmQiPgogICAgICAgIDxnIGlkPSIyNC1weC1JY29ucyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTM2NC4wMDAwMDAsIC0xMjQuMDAwMDAwKSIgc3Ryb2tlPSIjMDAwMDAwIj4KICAgICAgICAgICAgPGcgaWQ9ImljX2NhbmNlbCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzYwLjAwMDAwMCwgMTIwLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9ImNyb3NzIj4KICAgICAgICAgICAgICAgICAgICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1LjAwMDAwMCwgNS4wMDAwMDApIiBzdHJva2Utd2lkdGg9IjIiPgogICAgICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMCwwIEwxNC4xNDIxMzU2LDE0LjE0MjEzNTYiIGlkPSJMaW5lIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0xNCwwIEwxLjc3NjM1Njg0ZS0xNSwxNCIgaWQ9IkxpbmUiPjwvcGF0aD4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==" title="Закрыть окно">';
  html += '      </a>';
  html += '      <div class="custom-callback-modal__header">';
  if (typeof custom_callback_modal_title !== 'undefined' && custom_callback_modal_title) {
    html += '        <div class="custom-callback-modal__title">'+custom_callback_modal_title+'</div>';
  }
  html += '      </div>';
  html += '      <form action="'+custom_callback_modal_form_action+'" method="post" class="custom-callback-modal__form form-validator">';
  html += '        <div class="custom-callback-modal__form-row">';
  html += '          <div class="custom-callback-modal__form-col-left">';
  html += '            <div class="form-group">';
  // html += '              <input type="text" name="phone" class="form-control bfh-phone" data-format="+7 (ddd) ddd-dd-dd" data-minlength="18" placeholder="+7" required>';
  html += '              <input type="text" name="tel" class="form-control only_number" placeholder="Телефон" required>';
  html += '            </div>';
  html += '          </div>';
  if (typeof custom_callback_modal_form_btn !== 'undefined' && custom_callback_modal_form_btn) {
    html += '          <div class="custom-callback-modal__form-col-right">';
    html += '            <div class="form-group">';
    html += '              <button type="submit" class="btn custom-callback-modal__form-btn">'+custom_callback_modal_form_btn+'</button>';
    html += '            </div>';
    html += '          </div>';
  }
  html += '        </div>';

  if (typeof custom_callback_modal_agreement_text !== 'undefined' && custom_callback_modal_agreement_text) {
    html += '        <div class="custom-callback-modal__form-checkbox">';
    html += '          <div class="form-group">';
    html += '            <label class="p-l-0">';
    // html += '              <input type="checkbox" name="agreement" value="1" required>';
    // html += '              <span class="custom-checkbox-input"></span>';
    html += '              <span class="custom-checkbox-text">'+custom_callback_modal_agreement_text+'</span>';
    html += '            </label>';
    html += '          </div>';
    html += '        </div>';
  }

  if (typeof custom_callback_modal_subtitle !== 'undefined' && custom_callback_modal_subtitle) {
    html += '        <div class="custom-callback-modal__subtitle">'+custom_callback_modal_subtitle+'</div>';
  }

  html += '      </form>';
  html += '    </div>';
  html += '    <div class="custom-callback-modal__answer">';
  html += '      <a role="button" class="custom-callback-modal__close-btn">';
  html += '          <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjE3cHgiIGhlaWdodD0iMTdweCIgdmlld0JveD0iMCAwIDE3IDE3IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0MS4yICgzNTM5NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+aWNfY2FuY2VsPC90aXRsZT4KICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPgogICAgPGRlZnM+PC9kZWZzPgogICAgPGcgaWQ9Ikljb25zIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBzdHJva2UtbGluZWNhcD0icm91bmQiPgogICAgICAgIDxnIGlkPSIyNC1weC1JY29ucyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTM2NC4wMDAwMDAsIC0xMjQuMDAwMDAwKSIgc3Ryb2tlPSIjMDAwMDAwIj4KICAgICAgICAgICAgPGcgaWQ9ImljX2NhbmNlbCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzYwLjAwMDAwMCwgMTIwLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9ImNyb3NzIj4KICAgICAgICAgICAgICAgICAgICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1LjAwMDAwMCwgNS4wMDAwMDApIiBzdHJva2Utd2lkdGg9IjIiPgogICAgICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMCwwIEwxNC4xNDIxMzU2LDE0LjE0MjEzNTYiIGlkPSJMaW5lIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0xNCwwIEwxLjc3NjM1Njg0ZS0xNSwxNCIgaWQ9IkxpbmUiPjwvcGF0aD4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==" title="Закрыть окно">';
  html += '      </a>';
  html += '      <div class="custom-callback-modal__header">';
  if (typeof custom_callback_modal_answer_title !== 'undefined' && custom_callback_modal_answer_title) {
    html += '        <div class="custom-callback-modal__title">'+custom_callback_modal_answer_title+'</div>';
  }
  if (typeof custom_callback_modal_answer_subtitle !== 'undefined' && custom_callback_modal_answer_subtitle) {
    html += '        <div class="custom-callback-modal__subtitle">'+custom_callback_modal_answer_subtitle+'</div>';
  }
  html += '      </div>';
  if (typeof custom_callback_modal_answer_btn !== 'undefined' && custom_callback_modal_answer_btn) {
    html += '      <button type="button" class="btn custom-callback-modal__answer-btn">'+custom_callback_modal_answer_btn+'</button>';
  }
  html += '    </div>';
  html += '  </div>';
  html += '</div>';
  return html;
}

/** 
 * Аткрываем окно
 */
function custom_callback_modal_open() {
  $('.custom-callback-modal__answer').addClass('hidden');
  $('.custom-callback-modal__content').removeClass('hidden');
  $('body').addClass('custom-callback-modal-open');
}

/** 
 * Закрываем окно
 */
function custom_callback_modal_close() {
  $('body').removeClass('custom-callback-modal-open');
}

/**
 * Активируем плагин
 * wrapper - селектор контейнера (string)
 */
function custom_callback_start(wrapper) {
  var html = '';
  html += get_custom_callback_btn();
  html += get_custom_callback_modal();
  $(wrapper).html(html);

  if (typeof custom_callback_btn_color !== 'undefined' && custom_callback_btn_color) {
    if ($('.custom-callback__btn-wave').length > 0) {
      $('.custom-callback__btn-wave').css({'borderColor' : custom_callback_btn_color});
    }
    if ($('.custom-callback__btn').length > 0) {
      $('.custom-callback__btn').css({'backgroundColor' : custom_callback_btn_color});
    }
    if ($('.custom-callback-modal').length > 0) {
      // $('.custom-callback-modal').css({'backgroundColor' : custom_callback_btn_color});
    }
  }
  if (typeof custom_callback_modal_btn_color !== 'undefined' && custom_callback_modal_btn_color) {
    if ($('.custom-callback-modal__form-btn').length > 0) {
      $('.custom-callback-modal__form-btn').css({'backgroundColor' : custom_callback_modal_btn_color});
    }
    if ($('.custom-callback-modal__answer-btn').length > 0) {
      $('.custom-callback-modal__answer-btn').css({'backgroundColor' : custom_callback_modal_btn_color});
    }
  }
}

// Открываем окно при клике на кнопку
$(document).on('click', '.custom-callback__btn', function(){
  custom_callback_modal_open();
});

// Закрываем окно при клике на кнопку
$(document).on('click', '.custom-callback-modal__close-btn', function(){
  custom_callback_modal_close();
});

$(document).on('click', '.custom-callback-modal__answer-btn', function(){
  custom_callback_modal_close();
});

// показываем подсказку при наведении курсора на кнопку
$(document).on('mouseover', '.custom-callback__btn', function(){
  $(this).parents('.custom-callback').addClass('hover');
});
$(document).on('mouseout', '.custom-callback__btn', function(){
  $(this).parents('.custom-callback').removeClass('hover');
});



// активируем плагин
custom_callback_start('#custom-callback');



/**
 * Получаем значение cookie
 * name - название cookie (string)
 */
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}



// название cookie, в которой хранится запись о том что подсказка уже всплывала в этой сессии
var custom_callback_tooltip_open_CookieName = "custom-callback-tooltip-open";
var custom_callback_tooltip_open_Cookie = getCookie(custom_callback_tooltip_open_CookieName);

// переменная в которой хранится запись о том что подсказка уже всплывала в этой сессии
var custom_callback_tooltip_open_flag = false;

// показываем подсказку окно по таймеру
if (custom_callback_tooltip_open_Cookie != "yes") {
  if (typeof custom_callback_tooltip_timer !== 'undefined') {
    setTimeout(function(){
      if (custom_callback_tooltip_open_flag === false) {
        $('.custom-callback').addClass('hover');
        custom_callback_tooltip_open_flag = true;
        document.cookie = custom_callback_tooltip_open_CookieName + "=yes; path=/; domain=" + custom_callback_domain + ";";
      }
    }, custom_callback_tooltip_timer*1000);
  }
}



// название cookie, в которой хранится запись о том что окно уже открывалось в этой сессии
var custom_callback_modal_open_CookieName = "custom-callback-modal-open";
var custom_callback_modal_open_Cookie = getCookie(custom_callback_modal_open_CookieName);

// переменная в которой хранится запись о том что окно уже открывалось в этой сессии
var custom_callback_modal_open_flag = false;

// открываем окно при выходе
if (custom_callback_modal_open_Cookie != "yes") {
    $(document).mouseleave(function(e){
        if (e.clientY < 10 && custom_callback_modal_open_flag === false) {
            custom_callback_modal_open();
            custom_callback_modal_open_flag = true;
            document.cookie = custom_callback_modal_open_CookieName + "=yes; path=/; domain=" + custom_callback_domain + ";";
        }
    }); 
}

// открываем окно по таймеру
if (custom_callback_modal_open_Cookie != "yes") {
  if (typeof custom_callback_modal_timer !== 'undefined') {
    setTimeout(function(){
      if (custom_callback_modal_open_flag === false) {
        custom_callback_modal_open();
        custom_callback_modal_open_flag = true;
        document.cookie = custom_callback_modal_open_CookieName + "=yes; path=/; domain=" + custom_callback_domain + ";";
      }
    }, custom_callback_modal_timer*1000);
  }
}



/**
 * Кросс-браузерная функция для получения символа из события keypress
 */
function getChar(event) {
  if (event.which == null) {                     // IE
    if (event.keyCode < 32) return null;         // спец. символ
    return String.fromCharCode(event.keyCode)
  }
  if (event.which != 0 && event.charCode != 0) { // все кроме IE
    if (event.which < 32) return null;           // спец. символ
    return String.fromCharCode(event.which);     // остальные
  }
  return null;                                   // спец. символ
};

// Контроль ввода цифр
$('.only_number, .bfh-phone').on('keypress', function(e){
  e = e || event;
  if (e.ctrlKey || e.altKey || e.metaKey) return;
  var chr = getChar(e);
  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if (chr < '0' || chr > '9') {
    return false;
  }
});



// показываем/скрываем "+7" в поле ввода телефона
setTimeout(function(){
  $('.bfh-phone').each(function(){  
    if($(this).val() == '+7 ') $(this).val('');
  });
}, 200);
$('.bfh-phone').on('focus', function(){
  if($(this).val() == '') $(this).val('+7 ');
});

$('.bfh-phone').on('blur', function(){
  if($(this).val() == '+7 ') $(this).val('');
});



// валидация форм
setTimeout(function(){
  $('.custom-callback-modal .form-validator').validator({
    'focus' : false
  });
}, 250);



// Отправляем заявку
var customcallbackform_block = 0;

function custom_callback_send_form(form) {
  var modal = form.parents('.custom-callback-modal');

  if (form.length == 1) {
    var action = form.attr('action') || null;
    var method = form.attr('method') || null;
    var data = form.serialize();
    data = data + '&send=call&ajax=1';


    var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
    var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';
    if (csrf_name && csrf_value) {
      data = data + '&' + csrf_name + '=' + csrf_value;
    }

    if (typeof post_id !== 'undefined' && post_id) {
      data += '&page=' + post_id;
    }
    if (typeof category_id !== 'undefined' && category_id) {
      data += '&category=' + category_id;
    }
    if (typeof service_id !== 'undefined' && service_id) {
      data += '&service=' + service_id;
    }
    if (typeof page_url !== 'undefined' && page_url) {
      data += '&page-url=' + page_url;
    }

    $.ajax({
      url: '/send-validate/',
      type: method,
      data: data,
      success: function(res){
        if(res === 'ok'){
          form.find('input.form-control, textarea.form-control').val('');
          modal.find('.custom-callback-modal__content').addClass('hidden');
          modal.find('.custom-callback-modal__answer').removeClass('hidden');
          $('body').addClass('custom-callback-modal-open');

          $.ajax({
            url: '/send-confirm/',
            type: method,
            data: data,
            success: function(res){
              // console.log(res);
            }
          });

          // отправляем цель в яндекс метрике
          if (typeof ym === 'function') {
            if (typeof custom_callback_modal_metrika_target !== 'undefined' && custom_callback_modal_metrika_target) {
              // получаем id счетчиков, подключенных к странице
              var yandexMetrikaCounters = window.Ya._metrika.counters;
              for (var key in yandexMetrikaCounters) {
                if (yandexMetrikaCounters.hasOwnProperty(key)) {
                    var yandexMetrikaId = key.split(':');
                    if (yandexMetrikaId[0] !== 'undefined') {
                      ym(yandexMetrikaId[0], 'reachGoal', custom_callback_modal_metrika_target);
                    }
                }
              }
            }
          }

          // больше не открывать окно автоматичски в этой сессии
          if (custom_callback_modal_open_flag === false) {
            custom_callback_modal_open_flag = true;
            document.cookie = custom_callback_modal_open_CookieName + "=yes; path=/; domain=" + custom_callback_domain + ";";
          }
        }
        customcallbackform_block = 0;
      },
      error: function(){
        customcallbackform_block = 0;
      }
    });
  }
}





$(document).on('submit', '.custom-callback-modal__form', function(e){
  e.preventDefault();
  if ($(this).find('button.disabled[type="submit"]').length > 0) {
    return false;
  }
  if(customcallbackform_block === 1) return false;
  customcallbackform_block = 1;

  var form = $(this);

  if (typeof recaptcha_public_key !== 'undefined' && recaptcha_public_key) {
    grecaptcha.ready(function() {
      grecaptcha.execute(recaptcha_public_key, {action: 'send'}).then(function(token) {
        if (form.find('input[name="g-recaptcha-response"]').length == 0) {
          form.append('<input type="hidden" class="hidden" name="g-recaptcha-response">');
        }
        form.find('input[name="g-recaptcha-response"]').val(token);
        custom_callback_send_form(form);
      });
    });
  } else {
    custom_callback_send_form(form);
  }
  
return false;
});