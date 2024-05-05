<template>
    <div>
        <Link href="/listing">Listings</Link>
        <Link href="/listing/create">Create</Link>
    </div>
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot>Default</slot>
</template>

<script setup>
    import {Link, usePage} from '@inertiajs/vue3'
    import {computed} from 'vue'

    const page = usePage();
    const flashSuccess = computed(()=> page.props.flash.success)
</script>

<style scoped>
.success{
    background-color: green;
    color: white;
}
</style>
