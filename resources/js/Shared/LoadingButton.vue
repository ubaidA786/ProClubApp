<template>
    <button :disabled="loading.processing" class="flex items-center">
        <div v-if="loading.progress" class="fa fa-circle-notch fa-spin mr-2" />
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        loading: Boolean,
    },
};
</script>
