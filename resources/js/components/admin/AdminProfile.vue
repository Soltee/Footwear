<template>
    <div class="mb-16">
        <div>
            <form @submit.prevent="updateProfile">
                <div class="flex flex-row justify-between items-center mb-3">
                    <h3 class="text-admin-btn text-lg font-bold">Profile Picture</h3>
                    <button type="submit" class="ml-2 hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-tl-lg  rounded-br-lg focus:outline-none focus:shadow-outline">
                        Save
                    </button>
                </div>
                <div class="flex flex-col items-center  rounded-lg mb-3">
                    <div class="flex w-full items-center justify-center bg-grey-lighter mb-3">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-lg">Choose Profile Picture</span>
                            <input type='file' id="file" ref="file" class="hidden" @change="handleFileUpload" />
                        </label>
                    </div>
                    <div v-if="file" class="flex flex-row justify-around items-center">
                        <img :src="`${fileRead}`" class="w-24 h-24 rounded-full">
                        <svg v-on:click="removeFile()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red cursor-pointer">
                            <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                            <line x1="18" y1="9" x2="12" y2="15"></line>
                            <line x1="12" y1="9" x2="18" y2="15"></line>
                        </svg>
                    </div>
                    <div v-else>
                        <img v-if="avatar" :src="`/storage/${avatar}`" class="w-16 h-16 rounded-full object-cover object-center">
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-16 h-16 rounded-full object-cover object-center">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
        <div class="">
            <form @submit.prevent="updateProfile">
                <div class="flex flex-row justify-between items-center mb-3">
                    <h3 class="text-admin-btn text-lg font-bold">Profile Info</h3>
                    <button type="submit" class="ml-2 hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-tl-lg  rounded-br-lg focus:outline-none focus:shadow-outline">
                        Save
                    </button>
                </div>
                <div class="w-full">
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="first_name" class=" px-2 py-3 text-gray-800 text-md font-semibold ">First Name</label>
                        <input id="first_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="first_name">
                        <div v-if="nameErr" class="flex flex-col mt-3">
                            <p class="text-red-500 text-xs italic px-2 py-2">
                                First Name is required.
                            </p>
                            <p class="text-red-500 text-xs italic px-2 py-2">
                                First Name must be at least 4 character long.
                            </p>
                            <p v-for="e in firstErrArray" class="text-red-500 text-xs italic px-2 py-2">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="last_name" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Last Name</label>
                        <input id="last_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="last_name">
                        <div v-if="nameErr" class="flex flex-col mt-3">
                            <p class="text-red-500 text-xs italic px-2 py-2">
                                Last Name is required.
                            </p>
                            <p class="text-red-500 text-xs italic px-2 py-2">
                                Last Name must be at least 4 character long.
                            </p>
                            <p v-for="e in lastErrArray" class="text-red-500 text-xs italic px-2 py-2">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <label for="email" class=" px-2 py-3 text-gray-800 text-md font-semibold ">
                            E-Mail
                        </label>
                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="email">
                        <div v-if="emailErr" class="flex flex-col mt-3">
                            <p class="text-red-500 text-xs italic px-2 py-2">
                                Email must be valid.
                            </p>
                            <p v-for="e in emailErrArray" class="text-red-500 text-xs italic px-2 py-2">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <label for="password" class=" px-2 py-3 text-gray-800 text-md font-semibold ">
                            Password
                        </label>
                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="password" required>
                        <div v-if="passErr" class="flex flex-col mt-3">
                            <p v-for="e in passErrArray" class="text-red-500 text-xs italic px-2 py-2">
                                {{ e }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Confirm Password</label>
                        <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="confirm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Toast from '../helpers/Alert';

export default {
    name: 'admin-profile',
    props: {
        admin: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            avatar: '',
            file: '',
            fileRead: '',
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            confirm: '',
            nameErr: false,
            emailErr: false,
            nameErr: false,
            firstErrArray: [],
            lastErrArray: [],
            emailErrArray: [],
            passErr: false,
            passErrArray: [],
        }
    },
    mounted() {
        this.pushData();
    },
    methods: {
        pushData() {
            this.avatar = this.admin.avatar;
            this.email = this.admin.email;
            this.first_name = this.admin.first_name;
            this.last_name = this.admin.last_name;
        },

        updateProfile() {
            let formData = new FormData();

            if (this.first_name.length >= 4 || this.last_name.length >= 4) {
                if (this.email !== '') {
                    formData.append('first_name', this.first_name);
                    formData.append('last_name', this.last_name);
                    formData.append('email', this.email);
                    formData.append('password', this.password);
                    formData.append('password_confirmation', this.password);
                    formData.append('_method', 'PATCH');
                    if (this.file) {
                        formData.append('avatar', this.file);
                    }
                } else {
                    this.emailErr = true;
                    return;
                }

            } else {
                this.nameErr = true;
                return;
            }


            axios.post(`/admin/profile/${this.admin.id}`,
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((res) => {
                    if (res.status == 200) {


                        Toast.fire({
                            icon: 'success',
                            title: `Profile updated.`
                        });
                        if (res.data.avatar) {
                            // this.avatar = res.data.avatar;
                        }

                        // this.file     = '';
                        this.password = '';
                        this.confirm = '';
                        this.nameErr = false;
                        this.passErrArray = [];
                        this.firstErrArray = [];
                        this.lastErrArray = [];
                        this.emailErr = false;
                        this.emailErrArray = [];
                        this.passErr = false;
                        this.passErrArray = [];

                        window.location.reload();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'There was some network error!'
                        });
                    }

                })
                .catch((error) => {
                    let errors = error.response.data.errors;
                    Toast.fire({
                        icon: 'error',
                        title: 'There was some network error!'
                    });

                    if (errors.first_name) {
                        this.firstErrArray = errors.first_name;
                    }

                    if (errors.email) {
                        this.emailErrArray = errors.email;
                    }

                    if (errors.password) {
                        this.passErr = true;
                        this.passErrArray = errors.password;
                    }
                    // console.log(error.response.data.errors);
                });
        },
        handleFileUpload() {
            let uploadFile = this.$refs.file.files[0];
            this.file = uploadFile;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.fileRead = e.target.result;
            }

            if (uploadFile) {
                reader.readAsDataURL(uploadFile);
            }

        },
        removeFile() {
            this.file = '';
            this.fileRead = '';
        },
    }
};

</script>
