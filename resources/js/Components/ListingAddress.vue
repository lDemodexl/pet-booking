<template>
    <div>
        <div>{{ listing.city }} {{ listing.street }}</div>
        <div>Beds: {{ listing.beds }} | Baths: {{ listing.baths }}</div>
        <div>Area:{{ listing.area }} for {{ listing.price }}</div>
    </div>
</template>

<script setup>
    defineProps({
        listing: Object
    })
</script>
