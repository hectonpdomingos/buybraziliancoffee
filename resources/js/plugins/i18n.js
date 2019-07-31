import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

const messages = { 
       'en': {
        price: 'Price',
        producer: 'Producer',
        type: 'Type',
        buy: 'Buy',
        checkout: 'Checkout',
        pay: 'Pay',
        total: 'Total',
        customer: 'Customer',
        address: 'Address',
        previous: 'Previous',
        next: 'next',
        shippingaddress: 'Shipping Address',
        shipping: 'Shipping',
        orderby: 'Order By'
       },   
       'br': {
        price: 'Preço',
        producer: 'Produtor',
        type: 'Tipo',
        buy: 'Comprar',
        checkout: 'Carrinho',
        pay: 'Pagar',
        total: 'Total',
        customer: 'Cliente',
        address: 'Endereço',
        previous: 'Anterior',
        next: 'Próximo',
        shippingaddress: 'Endereço de envio',
        shipping: 'Envio',
        orderby: 'Ordenar por'
       },
       'ru': {
        price: 'Стоимость',
        producer: 'Производитель',
        type: 'Тип',
        buy: 'Купить',
        checkout: 'проверять',
        cart: 'Корзина',
        pay: 'Оплатить',
        total: 'Всего',
        customer: 'Клиент',
        address: 'Адрес',
        previous: 'предыдущая',
        next: 'следующая',
        shippingaddress: 'адрес доставки',
        shipping: 'доставкa',
        orderby: 'Сортировать по'

       }
};


const i18n = new VueI18n({ 
       locale: 'ru', // set locale    fallbackLocale: 'es', // set fallback locale   
       messages, // set locale messages
    });
export default i18n;