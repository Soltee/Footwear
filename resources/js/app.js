/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo);
export const serverBus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/****** Components For Administrator ******/
Vue.component('admin-bar', require('./components/admin/AdminBar.vue').default);
Vue.component('search-all-view', require('./components/admin/SearchAll.vue').default);
Vue.component('admin-profile', require('./components/admin/AdminProfile.vue').default);

//Products
Vue.component('create-product', require('./components/admin/products/CreateProduct.vue').default);
Vue.component('products-view', require('./components/admin/products/Products.vue').default);

//Categories
Vue.component('categories-view', require('./components/admin/categories/Categories.vue').default);

//Customers
Vue.component('customers-view', require('./components/admin/customers/Customers.vue').default);

//Payments
Vue.component('payments-view', require('./components/admin/payments/Payments.vue').default);


/***** Components for Customers ******/
Vue.component('navmenu', require('./components/customer/Navmenu.vue').default);
Vue.component('add-to-cart', require('./components/customer/Product.vue').default);
Vue.component('footer-view', require('./components/customer/Footer.vue').default);
Vue.component('cart-checkout', require('./components/customer/Checkout.vue').default);
Vue.component('cart-view', require('./components/customer/Cart.vue').default);
Vue.component('add-cart', require('./components/customer/AddToCart.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
