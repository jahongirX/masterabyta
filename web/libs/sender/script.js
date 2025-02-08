const forms = document.querySelectorAll('.leadback-popup__form');


forms.forEach((form) => {
    form.addEventListener('submit', (e) => {
        grecaptcha.ready(function(){
            grecaptcha.enterprise.execute('6LfuNzQmAAAAAEXRUAcIQUKPZyE3L1qFusoYaPeb', {action:'login'}).then(function(token){
                console.log(11111)
                e.preventDefault();
                if (form.querySelector('input[name="isBotChecker"]').value.length > 0) {
                    console.log('1_');
                    return false;
                } else {
                    form.querySelector('input[name="phone"]').style.border = '1px solid #00d0e8';
                    let formPhone = 'неизвестен';
                    let formName = 'неизвестно';
                    let formQuestion = 'отсутствует';

                    const pageUrl = window.location.href,
                        pageTitle = document.title.split('-')[0],
                        pageCity = document.querySelector('.header-town-current').textContent;
                    console.log(pageCity, pageTitle, pageUrl)

                    if (form.querySelector('input[name="phone"]').value.includes('_')) {
                        form.querySelector('input[name="phone"]').style.border = '1px solid red';
                        return;
                    } else {
                        formPhone = form.querySelector('input[name="phone"]').value;
                    }

                    if (form.querySelector('input[name="name"]')) formName = form.querySelector('input[name="name"]').value;
                    if (form.querySelector('textarea[name="question"]')) formQuestion = form.querySelector('textarea[name="question"]').value;


                    var xhr = new XMLHttpRequest();
                    // Определяем метод и URL для отправки данных на сервер
                    xhr.open("POST.html", "sender/sendmail.html", true);

                    // Определяем заголовки запроса
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    console.log(formPhone, formName)

                    xhr.send("phone=" + encodeURIComponent(formPhone)
                        + "&name=" + encodeURIComponent(formName) + "&question=" + encodeURIComponent(formQuestion)
                        + "&url=" + encodeURIComponent(pageUrl) + "&title=" + encodeURIComponent(pageTitle)
                        + "&city=" + encodeURIComponent(pageCity));

                    // Обработчик события изменения состояния запроса
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                $('.popsuccess').show();
                                $('.popform').hide();
                                form.reset();
                                yaCounter50665042.reachGoal(50253756);
                            } else {
                                alert("Произошла ошибка при отправке данных. Попробуйте позднее");
                            }
                        }
                    };
                }
            });
        });
    });
});


const selector = document.querySelectorAll('input[name="phone"]');

const im = new Inputmask("+7 (999) 999-99-99");
selector.forEach((phone) => im.mask(phone));
