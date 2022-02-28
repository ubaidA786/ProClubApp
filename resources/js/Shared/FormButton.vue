<template>
    <button
        :type="type"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-purple-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:bg-purple-300"
    >
        <div v-if="form.processing" class="mr-1">
            <i class="fa fa-circle-notch fa-spin"></i>
        </div>
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        form: Object,
        type: {
            type: String,
            default: "submit",
        },
    },
};
</script>
