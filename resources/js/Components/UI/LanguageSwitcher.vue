<template>
    
     <div class="flex justify-center items-center gap-1">
        <div v-for="locale, name in locales" :key="locale">
            <span v-if="locale === current_locale" class="text-gray-700">{{ name }}</span>
            <Link as="button" method="post" v-else class="underline" :href="route('locale', locale)">
                <span>{{ name }}</span>
            </Link>
        </div>
    </div>
</template>

<script setup>
import {computed} from 'vue'
import {Link} from '@inertiajs/vue3'
const props = defineProps({
    locales: Object,
    current_locale: String
})

const locales = computed(()=>props.locales)
const current_locale = computed(()=>props.current_locale)
</script>
