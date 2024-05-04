<template>
    <div>
        <Link href="/">Index Page</Link>
        <Link href="/hello">Show Page</Link>
    </div>
    <div>layout timer {{ counter }}</div>
    <slot>Default</slot>
</template>

<script setup>
    import {ref} from 'vue'
    import {Link} from '@inertiajs/vue3'
    const counter = ref(0)
    setInterval(() => counter.value++, 1000)
</script>
