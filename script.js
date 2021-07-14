// Объект с курсом валют
const rates = {};

// Получение полей option
const elementUSD = document.getElementById('USD');
const elementEUR = document.getElementById('EUR');
const elementGBP = document.getElementById('GBP');

// Получение полей input
const input = document.getElementById('input');
const result = document.getElementById('result');
const select = document.getElementById('select');

getCurrencies ();

// Получение валют, запись их в объект, вывод на страницу в полях option
async function getCurrencies () {
    const response = await fetch('https://www.cbr-xml-daily.ru/daily_json.js');
    const data = await response.json();
    const result = await data; 

    rates.USD = result.Valute.USD;
    rates.EUR = result.Valute.EUR;
    rates.GBP = result.Valute.GBP;
    
    elementUSD.textContent = `USD = ${rates.USD.Value.toFixed(2)}`
    elementEUR.textContent = `EUR = ${rates.EUR.Value.toFixed(2)}`
    elementGBP.textContent = `GBP = ${rates.GBP.Value.toFixed(2)}`
}

// События на странице в полях input и select
input.addEventListener('input', convertValue);

select.addEventListener('input', convertValue);

// Функция расчёта
function convertValue() {
    result.value = (parseFloat(input.value) /  rates[select.value].Value).toFixed(2);
}

const form = document.getElementById('form');
form.addEventListener('submit', formSend);

async function formSend(e) {
    e.preventDefault();

    let formData = new FormData(form);
    console.log(formData)

    let response = await fetch('sendmail.php', {
        method: 'POST',
        body: formData
    });

    if(response.ok) {
        let result = await response.json();
        alert('Отправлено!');
        form.reset();
    } else {
        alert('Ошибка!');
    }
}



