<template>
  <public-layout title="Passcode">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Protected : Media Access
      </h2>
    </template>
    <jet-authentication-card>
      <jet-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Media Access
      </h2>
      <form @submit.prevent="submit">
        <div>
          <jet-label
            for="passcode"
            value="Please enter the passcode bellow to access your media"
          />
          <jet-input
            id="passcode"
            type="text"
            class="mt-1 block w-full"
            v-model="form.passcode"
            required
            autofocus
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <jet-button
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Access Media
          </jet-button>
        </div>
      </form>
    </jet-authentication-card>
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
    canResetPassword: Boolean,
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
        .get(this.route("validatepasscode"), {
          onFinish: () => this.form.reset("passcode"),
        });
    },
  },
});
</script>
