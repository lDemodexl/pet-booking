<template>
   <h2>You need to be verified to see this page!</h2>
   <div>
      <Link 
         class="text-indigo-600 dark:text-indigo-400"
         as="button" 
         method="post" 
         :href="route('verification.send')"
      >
            Resend verification email
      </Link>
   </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>
