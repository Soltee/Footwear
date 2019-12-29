<template>
	<p  v-if="message"  class="fixed top-0 right-0 w-auto z-20 text-center py-3 px-4 rounded-lg text-md font-medium bg-green-500 text-white">
            {{ message }}
    </p>
</template>
<script>
	export default {
		name : 'mge',
		props: ['message'],
	}
</script>