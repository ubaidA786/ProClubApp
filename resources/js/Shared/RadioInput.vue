<template>
    <div class="flex items-center">
        <input
            :id="id"
            ref="input"
            v-bind="$attrs"
            class="form-input"
            :value="label"
            :class="{ error: error }"
            :type="type"
            @change="$emit('input', label)"
        />
        <label v-if="label" class="ml-3" :for="id">
            <span class="block text-sm font-medium text-gray-700">{{
                label
            }}</span>
        </label>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            // default() {
            //   return `text-input-${this._uid}`
            // },
        },
        type: {
            type: String,
            default: "text",
        },
        value: String,
        label: String,
        error: String,
        checked: String,
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
        change() {
            this.$refs.input.select();
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end);
        },
    },
};
</script>
