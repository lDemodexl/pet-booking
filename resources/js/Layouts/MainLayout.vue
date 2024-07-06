<template>
    <header class="w-full border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-white">
        <div class="container mx-auto">
            <nav class="p-4 grid grid-cols-1 items-center lg:grid-cols-3 relative">
                <div class="text-lg font-medium hidden lg:block">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">LaraZillow</Link>
                </div>
                <button type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 absolute top-1/2 right-2 -translate-y-1/2" @click.prevent="toggleMobileMenu">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                </button>
                <div class="flex lg:block w-full lg:w-auto lg:relative fixed top-0 right-0 h-full w-full items-center justify-end lg:translate-x-0 lg:animate-none" :class="{'animate-fade_in':openMobileMenu=='in', 'animate-fade_out':openMobileMenu=='out','translate-x-full':!openMobileMenu}">
                    <div class="z-0 opacity-75 dark:bg-gray-800 bg-black absolute top-0 bottom-0 left-0 right-0"></div>
                    <span class="z-20 absolute top-2 right-4 lg:hidden border rounded-full border-black dark:border-white p-1 text-sm w-[30px] h-[30px] text-center cursor-pointer" @click.prevent="toggleMobileMenu">X</span>
                    <div 
                        class="z-10 dark:bg-gray-800 bg-white flex items-end lg:items-center gap-4 text-lg font-medium flex-col lg:flex-row lg:justify-end min-w-fit w-10/12 h-full lg:w-full p-6 pt-20 lg:p-0 z-10 translate-x-full lg:translate-x-0 lg:animate-none" :class="{'animate-slide_in':openMobileMenu=='in', 'animate-slide_out':openMobileMenu=='out'}"
                        v-if="user"
                        @click="toggleMobileMenu"
                        >
                        
                        <Link class="text-lg font-medium lg:hidden block border-b border-gray-500 lg:border-0 w-full lg:w-auto text-right" :href="route('listing.index')">Listings</Link>
                       
                        <Link :href="route('notification.index')"  class="text-gray-500 relative pr-2 py-2 text-lg border-b w-full lg:w-auto text-right lg:border-0 border-gray-500">
                            <span class="hidden lg:inline-block">🔔</span>
                            <span class="text-white lg:hidden">Notifications</span>
                            <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border-white dark:border-gray-900 rounded-full text-xs text-center">
                                {{ notificationCount }}
                            </div>
                        </Link>
                        <Link :href="route('realtor.listing.index')" class="lg:text-sm text-gray-500 dark:text-gray-300 border-b border-gray-500 w-full lg:w-auto text-right lg:border-0">
                            {{ user.name }}
                        </Link>
                        <Link :href="route('realtor.listing.create')" class="lg:btn-primary border-b border-gray-500 lg:border-0 w-full lg:w-auto text-right">New Listing</Link>
                        
                        <Link class="border-b border-gray-500 w-full lg:w-auto text-right lg:border-0" :href="route('logout')" method="delete" as="button">Logout</Link>
                        
                        <LanguageSwitcher :locales="page.props.locales" :current_locale="page.props.current_locale"/>
                    </div>
                    <div class="z-10 dark:bg-gray-800 bg-white flex items-end lg:items-center gap-2 text-lg font-medium flex-col lg:flex-row lg:justify-end min-w-fit w-10/12 h-full lg:w-full p-6 pt-20 lg:p-0 z-10 translate-x-full lg:translate-x-0 lg:animate-none" :class="{'animate-slide_in':openMobileMenu=='in', 'animate-slide_out':openMobileMenu=='out'}" @click="toggleMobileMenu" v-else>
                        <Link :href="route('user-account.create')">Register</Link>
                        <Link :href="route('login')">Sign-In</Link>
                        <LanguageSwitcher :locales="page.props.locales" :current_locale="page.props.current_locale" />
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
    
</template>

<script setup>
    import LanguageSwitcher from '@/Components/UI/LanguageSwitcher.vue'
    import {Link, usePage} from '@inertiajs/vue3'
    import {ref,computed} from 'vue'


    const page = usePage();
    const flashSuccess = computed(()=> page.props.flash.success)
    const user = computed(()=>page.props.user)
     
    const notificationCount = computed(
        () => Math.min(page.props.user.notification_count,9),
    )

    const openMobileMenu = ref(0);
    const toggleMobileMenu = () => {
        openMobileMenu.value = openMobileMenu.value == 'in'?'out':'in'
    }
</script>

