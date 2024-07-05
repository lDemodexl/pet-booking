<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">{{ trans('forms.email')}}</label>
                <input v-model="form.email" type="text" id="email" class="form-input">
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">{{ trans('forms.password')}}</label>
                <input v-model="form.password" type="password" id="password" class="form-input">
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">{{ trans('forms.login')}}</button>
                <div class="mt-2 text-center">
                    <Link :href="route('user-account.create')" class="text-sm text-gray-500">{{ trans('forms.register')}}'</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { useForm, Link } from '@inertiajs/vue3';
    import { trans } from "laravel-vue-i18n";

    const form = useForm({
        email: null,
        password: null
    })
    const login = () => form.post(route('login.store'))
</script>
