<template>
  <public-layout title="Default">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <welcome name="Public" />
        </div>
      </div>
    </div>
  </public-layout>
</template>

<script>
import PublicLayout from "@/Layouts/PublicLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
export default {
  components: {
    PublicLayout,
    Welcome,
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
};
</script>
