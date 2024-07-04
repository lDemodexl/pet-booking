<template>
    <div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
        <Box v-if="listing.images.length" class="md:col-span-7 flex items-center justify-center w-full text-gray-500 text-center font-bold">
            <div  class="grid grid-cols-2 gap-1">
                <img 
                    v-for="image in listing.images" 
                    :key="image.id" 
                    :src="image.src">
            </div>
        </Box>

        <EmptyState class="md:col-span-7 flex items-center justify-center w-full text-gray-500 text-center font-bold" v-else>No images</EmptyState>

        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic Info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold"></Price>
                <ListingSpace :listing="listing" class="text-lg"></ListingSpace>
                <ListingAddress :listing="listing" class="text-gray-500"></ListingAddress>
            </Box>
            <Box>
                <template #header>
                    Monthly payment
                </template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%)</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 roounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input v-model.number="duration" type="range" min="3" max="35" step="1" class="w-full h-4 bg-gray-200 roounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

                    <div class="text-gray-600 dark:text-gray-300 mt-2 ">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl"></Price>
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div>
                                <Price :price="listing.price" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div>
                                <Price :price="totalInterest" class="font-medium"/>
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer
                @offer-updated="offer = $event"
                v-if="user && !offerMade" 
                :listing-id="listing.id" 
                :price="listing.price"/>
            <OfferMade :offer="offerMade" v-if="user && offerMade"/>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';
import {ref, computed} from 'vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import MakeOffer from '@/Pages/Listing/Show/Components/MakeOffer.vue';
import OfferMade from '@/Pages/Listing/Show/Components/OfferMade.vue';
import { usePage } from '@inertiajs/vue3';
import EmptyState from '@/Components/UI/EmptyState.vue';

const props = defineProps({
    listing:Object,
    offerMade: Object,
})
console.log(OfferMade)
const offer = ref(props.listing.price)

const interestRate = ref(2.5)
const duration = ref(25)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(offer, interestRate, duration)
const page = usePage();
const user = computed(()=>page.props.user)
</script>
