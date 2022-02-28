<template>
    <i :class="'fal fa-lg fa-' + icon" />
</template>

<script>
export default {
    props: {
        icon: String,
    },
};
</script>
