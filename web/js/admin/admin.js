// удаление изображения
$(".del-link").click(function(){
  var res=confirm("Подтвердите удаление");
  if(!res) return false;
});



/* --- Контроль ввода цифр --- */

function getChar(event) {        // Кросс-браузерная функция для получения символа из события keypress:
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

$('.only_number, .bfh-phone').on('keypress', function(e){     // ВВОД ТОЛЬКО ЦИФР
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

$('.float_number').on('keypress', function(e){     // ВВОД ЧИСЕЛ ТИПА FLOAT
  e = e || event;
  if (e.ctrlKey || e.altKey || e.metaKey) return;
  var chr = getChar(e);
  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if( chr != '.'){
    if (chr < '0' || chr > '9') {
      return false;
    }
  }
});


$('.float_number').on('keyup', function(){
  if( $(this).val().match(/\.\d*\./) ){
    var float_value = parseFloat( $(this).val() ) | 0;
    $(this).val( float_value );
  }
});

/* end --- Контроль ввода цифр --- end */



/* --- Инициализируем bootstrap.datepicker --- */
var selector_datepicker = new Array(
    '.datepicker .form-control',
    'input[name="NewsSearch[date]"]',
    'input[name="BuySearch[date]"]',
    'input[name="OrderSearch[date]"]',
    'input[name="OrderSearch[control]"]',
    'input[name="OrderSearch[recompense_date]"]',
    'input[name="AutoorderSearch[date]"]',
    'input[name="AutoorderSearch[control]"]',
    'input[name="TaskSearch[date]"]',
    'input[name="TaskSearch[control]"]',
    'input[name="HistorySearch[date]"]',
    'input[name="AffiliateSearch[date]"]',
    'input[name="NoticeSearch[date]"]',
    'input[name="NoticeSearch[seen]"]',
    'input[name="AffiliatepayoffSearch[date_start]"]',
    'input[name="AffiliatepayoffSearch[date_end]"]',
    'input[name="DissonanceSearch[date]"]',
    'input[name="LogSearch[date]"]',
    'input[name="PayoutSearch[date]"]',
    'input[name="PromocodeActivationSearch[date]"]',
    'input[name="UserSearch[date_reg]"]',
    'input[name="UserSearch[date_reg_start]"]',
    'input[name="UserSearch[date_reg_end]"]',
    'input[name="UserSearch[date_last_pay]"]',
    'input[name="HistorySearch[date_start]"]',
    'input[name="HistorySearch[date_end]"]',
    'input[name="HistorySearch[user_date_reg_start]"]',
    'input[name="HistorySearch[user_date_reg_end]"]',
    'input[name="TaskSearch[user_date_reg_start]"]',
    'input[name="TaskSearch[user_date_reg_end]"]',
    'input[name="TaskSearch[date_start]"]',
    'input[name="TaskSearch[date_end]"]',
    'input[name="UserMailingSearch[date]"]',
    'input[name="UserMailing[date]"]',
    'input[name="UserMailing[last_send_date]"]',
    'input[name="UserMailingForm[date]"]',
    'input[name="UserMailingForm[last_send_date]"]',
    'input[name="UserMailingForm[date_reg_min]"]',
    'input[name="UserMailingForm[date_reg_max]"]',
    'input[name="BlacklistSearch[date]"]',
    'input[name="OrderSearch[date_start]"]',
    'input[name="OrderSearch[date_end]"]',
    'input[name="OrderSearch[user_date_reg_start]"]',
    'input[name="OrderSearch[user_date_reg_end]"]',
    'input[name="BlogSearch[date]"]',
    'input[name="RecompenseSearch[date]"]',
    'input[name="RecompenseSearch[date_start]"]',
    'input[name="RecompenseSearch[date_end]"]',
    'input[name="RecompenseSearch[order_date_start]"]',
    'input[name="RecompenseSearch[order_date_end]"]',
    'input[name="ArchiveHistorySearch[date]"]',
    'input[name="ArchiveHistorySearch[date_start]"]',
    'input[name="ArchiveHistorySearch[date_end]"]',
    'input[name="ArchiveHistorySearch[user_date_reg_start]"]',
    'input[name="ArchiveHistorySearch[user_date_reg_end]"]',
    'input[name="ArchiveOrderSearch[date]"]',
    'input[name="ArchiveOrderSearch[recompense_date]"]',
    'input[name="ArchiveOrderSearch[date_start]"]',
    'input[name="ArchiveOrderSearch[date_end]"]',
    'input[name="ArchiveOrderSearch[user_date_reg_start]"]',
    'input[name="ArchiveOrderSearch[user_date_reg_end]"]',
    'input[name="ArchiveTaskSearch[date]"]',
    'input[name="ArchiveTaskSearch[date_start]"]',
    'input[name="ArchiveTaskSearch[date_end]"]',
    'input[name="ArchiveTaskSearch[user_date_reg_start]"]',
    'input[name="ArchiveTaskSearch[user_date_reg_end]"]',
    'input[name="ArchiveRecompenseSearch[date]"]',
    'input[name="ArchiveRecompenseSearch[date_start]"]',
    'input[name="ArchiveRecompenseSearch[date_end]"]',
    'input[name="ArchiveRecompenseSearch[order_date_start]"]',
    'input[name="ArchiveRecompenseSearch[order_date_end]"]',
    'input[name="ArchiveUserSearch[date_last_pay]"]',
    'input[name="ArchiveUserSearch[date_reg_start]"]',
    'input[name="ArchiveUserSearch[date_reg_end]"]',
    'input[name="FreelikeSearch[date]"]',
    'input[name="ReviewSearch[date]"]',
    'input[name="WalletSearch[date]"]',
    'input[name="FreefollowerSearch[date]"]',
    'input[name="ProxyCheckSearch[date]"]',
    'input[name="RequestSearch[date]"]'
  );
selector_datepicker = selector_datepicker.join(',');
$(selector_datepicker).datepicker({
    format: "dd.mm.yyyy",
    orientation: "bottom auto",
    clearBtn: true,
    language: "ru",
    autoclose: true
});
/* end --- Инициализируем bootstrap.datepicker --- end */



/* --- инициализируем timepicker --- */
$('.timepicker').each(function(){
  var current_val = $(this).val();
  if(!current_val) current_val = '00:00';
  $(this).wickedpicker({
    now: current_val,
    twentyFour: true,
    title: "Время",
  });
});
/* end --- инициализируем timepicker --- end */




/* --- Транслитератор --- */
function transliterator(param){
  if(param){
    param = param.toLowerCase();
    param = param.replace(/\./g, "-");
    param = param.replace(/,/g, "-");
    param = param.replace(/ /g, "-");
    param = param.replace(/_/g, "-");
    param = param.replace(/а/g, "a");
    param = param.replace(/б/g, "b");
    param = param.replace(/в/g, "v");
    param = param.replace(/г/g, "g");
    param = param.replace(/д/g, "d");
    param = param.replace(/е/g, "e");
    param = param.replace(/ё/g, "yo");
    param = param.replace(/ж/g, "zh");
    param = param.replace(/з/g, "z");
    param = param.replace(/и/g, "i");
    param = param.replace(/й/g, "y");
    param = param.replace(/к/g, "k");
    param = param.replace(/л/g, "l");
    param = param.replace(/м/g, "m");
    param = param.replace(/н/g, "n");
    param = param.replace(/о/g, "o");
    param = param.replace(/п/g, "p");
    param = param.replace(/р/g, "r");
    param = param.replace(/с/g, "s");
    param = param.replace(/т/g, "t");
    param = param.replace(/у/g, "u");
    param = param.replace(/ф/g, "f");
    param = param.replace(/х/g, "h");
    param = param.replace(/ц/g, "ts");
    param = param.replace(/ч/g, "ch");
    param = param.replace(/ш/g, "sh");
    param = param.replace(/щ/g, "sch");
    param = param.replace(/ъ/g, "");
    param = param.replace(/ы/g, "yi");
    param = param.replace(/ь/g, "");
    param = param.replace(/э/g, "e");
    param = param.replace(/ю/g, "yu");
    param = param.replace(/я/g, "ya");
    param = param.replace(/\-+/g, '-');
    param = param.replace(/[^a-z0-9-]/g, '');
    return param;
  }
  return false;
}
/* end --- Транслитератор --- end */




/* --- Автоматически заполняем поле alias --- */
function custom_alias_cotrol(name_field, alias_field){
  var alias_field_selector = name_field.attr('data-aliasfield');
  if(alias_field_selector){
    alias_field_selector = 'input[name="' + alias_field_selector + '"]';
    var alias_field = $(alias_field_selector);
    if(alias_field.length > 0){
      var alias = alias_field.val();
      if(!alias){
        var name = name_field.val();
        alias = transliterator(name);
        if(!alias) alias = '';
        alias_field.val(alias);
      }
    }
  }
}

$(document).on('change', 'input[data-aliasfield]', function(){
  var name_field = $(this);
  var alias_field = name_field.attr('data-aliasfield');
  custom_alias_cotrol(name_field, alias_field);
});
/* end --- Автоматически заполняем поле alias --- end */




/* --- Выводим кнопку очистить фильтр --- */
$('.admin-table-filter-close-column').each(function(){
  var href = $(this).attr('data-to');
  var current = $(this).attr('data-current');
  if(typeof href !== 'undefined' && typeof current !== 'undefined'){
    if(href !== current){
      var btn = '<a class="admin-table-filter-close-btn" href="'+href+'"><i class="fa fa-times" aria-hidden="true"></i></a>';
      $(this).html(btn);
    }
  }
});
/* end --- Выводим кнопку очистить фильтр --- end */




/* --- Выпадающие списки в меню --- */

$('.navbar-collapse .dropdown-submenu>a').on('click', function(e){
  return false;
});

/* end --- Выпадающие списки в меню --- end */



$('.GridView-rows').on('change', function(){
  var url = $(this).attr('data-url');
  var rows = $(this).val();
  url = url.replace("per-page=20", "per-page="+rows);
  document.location.href = url;
});





$(document).on('change', '.checkboxList-toggle-all', function(){
  var checkboxList = $(this).parents('.checkboxList');
  var inputs = checkboxList.find('.form-group :checkbox');
  if (inputs.length > 0) {
    if ($(this).prop('checked')) {
      inputs.prop('checked', true);
    } else {
      inputs.prop('checked', false);
    }
  }
});







$(document).on('change', 'input[type="checkbox"].checkbox-blockunique-toggle', function(){
  if ($(this).prop('checked')) {
    $(this).parents('.panel-default').find('.blockunique-toggle-form').addClass('active');
  } else {
    $(this).parents('.panel-default').find('.blockunique-toggle-form').removeClass('active');
  }
});




// Чекбокс "Выбрать все" в модальном окне
$(document).on('change', '#toggle-check-all', function(){
  var form = $(this).parents('form');
  if (form.length == 1) {
    if ($(this).prop('checked')) {
      form.find(':checkbox').each(function(){
        $(this).prop('checked', true);
      });
    } else {
      form.find(':checkbox').each(function(){
        $(this).prop('checked', false);
      });
    }
  }
});



// Чекбокс "Выбрать все" в таблице записей
$('.grid-view-check-all-rows').html('<input type="checkbox" name="1" value="1">');
$(document).on('change', '.grid-view-check-all-rows :checkbox', function(){
  var table = $(this).parents('table.table');
  var rows_checkbox = table.find('tbody>tr>td:first-child>:checkbox');
  if ($(this).is(':checked')) {
    rows_checkbox.prop('checked', true);
  } else {
    rows_checkbox.prop('checked', false);
  }
});





// Переключаем табы с прайсом через select
$(document).on('change', 'select[data-toggle="nav-tabs-change"]', function(){
  var nav = $(this).attr('data-target') || null;
  var href = $(this).val() || null;
  if (nav && href !== null) {
    var selector = nav + ' a[href="'+href+'"]';
    $(selector).click();
  }
});