<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600 ml-3">
            {{ message }}*
        </p>
    </div>
</template>
