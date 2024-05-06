<template>
    <div>
        <div>{{ listing.city }}, {{ listing.street }} {{ listing.street_nr }}</div>
    </div>
</template>

<script setup>
    defineProps({
        listing: Object
    })
</script>
