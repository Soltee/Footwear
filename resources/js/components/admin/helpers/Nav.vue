<template>

    <ul class="m-0 flex flex-col justify-start items-left ">
        <li class="mb-3">
            <a  href="/admin/dashboard" class="text-gray-900 text-md font-bold flex flex-row bg-admin-btn-hover hover:bg-admin-btn rounded-lg px-3 py-2  items-center">
                <svg class="h-8 w-8 text-white"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.757 2.14c.255-.02.51-.029.757-.029s.502.01.757.029v3.115c-.251-.028-.505-.042-.757-.042s-.506.014-.757.042v-3.115zm-5.765 7.977l-2.879-1.193c.156-.478.351-.948.58-1.399l2.879 1.193c-.245.443-.44.913-.58 1.399zm1.217-2.35l-2.202-2.204c.329-.383.688-.742 1.071-1.071l2.203 2.203c-.396.317-.755.676-1.072 1.072zm.794-4.569c.449-.231.918-.428 1.396-.586l1.205 2.874c-.486.142-.954.339-1.396.586l-1.205-2.874zm4.511 14.31c-1.358 0-2.459-1.101-2.459-2.459 0-.927.513-1.734 1.27-2.153l1.189-5.572 1.189 5.572c.757.419 1.271 1.226 1.271 2.153-.001 1.358-1.102 2.459-2.46 2.459zm1.884-12.029l1.193-2.879c.479.157.948.352 1.399.581l-1.193 2.878c-.444-.246-.913-.44-1.399-.58zm2.349 1.216l2.203-2.203c.383.329.742.688 1.071 1.071l-2.203 2.203c-.316-.395-.675-.754-1.071-1.071zm2.259 3.321c-.147-.483-.35-.95-.603-1.39l2.86-1.238c.235.445.437.912.602 1.39l-2.859 1.238z"/></svg>

                <span class="ml-3 text-white">Dashboard</span>
            </a>
        </li>
        <li class="mb-3">
            <a href="/admin/products" class="text-gray-900 text-md font-bold flex flex-row items-center bg-admin-btn-hover hover:bg-admin-btn rounded-lg px-3 py-2 ">
                <svg class="h-8 w-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M11.499 12.03v11.971l-10.5-5.603v-11.835l10.5 5.467zm11.501 6.368l-10.501 5.602v-11.968l10.501-5.404v11.77zm-16.889-15.186l10.609 5.524-4.719 2.428-10.473-5.453 4.583-2.499zm16.362 2.563l-4.664 2.4-10.641-5.54 4.831-2.635 10.474 5.775z"/></svg>

                <span class="ml-3 text-white">Products</span>
            </a>
        </li>
        <li class="mb-3">
            <a href="/admin/customers" class="text-gray-900 text-md font-bold flex flex-row items-center bg-admin-btn-hover hover:bg-admin-btn rounded-lg px-3 py-2  ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>    

                <span class="ml-3 text-white">Customers</span>
            </a>
        </li>
        <li class="mb-3">
            <a href="/admin/payments" class="text-gray-900 text-md font-bold flex flex-row  bg-admin-btn-hover hover:bg-admin-btn rounded-lg px-3 py-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22 4h-20c-1.104 0-2 .896-2 2v12c0 1.104.896 2 2 2h20c1.104 0 2-.896 2-2v-12c0-1.104-.896-2-2-2zm0 13.5c0 .276-.224.5-.5.5h-19c-.276 0-.5-.224-.5-.5v-6.5h20v6.5zm0-9.5h-20v-1.5c0-.276.224-.5.5-.5h19c.276 0 .5.224.5.5v1.5zm-9 6h-9v-1h9v1zm-3 2h-6v-1h6v1zm10-2h-3v-1h3v1z"/></svg>

                <span class="ml-3 text-white">Payments</span>
            </a>
        </li>
    </ul>
  
</template>

<script>
// import { serverBus } from '../../../app.js';    
// import Toast from '../../helpers/Alert';

    export default {
        name : 'Menu',
        props: {

        },
        mounted() {
        },
        methods: {

        }
    }
</script>
