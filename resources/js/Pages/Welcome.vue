<template>
  <public-layout title="Public">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Welcome Page
      </h2>
    </template>
    <div v-if="$page.props.canLogin">Can Login</div>
  </public-layout>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
export default defineComponent({
  components: {
    Head,
    PublicLayout,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canLogin: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        passcode: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
        }))
        .get(this.route("organization.check"), {
          onFinish: () => this.form.reset("passcode"),
        });
    },
  },
});
</script>
