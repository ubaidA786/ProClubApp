<template>
  <app-layout title="Add User">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add User
      </h2>
    </template>
    <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
      <form @submit.prevent="store" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-8 divide-y divide-gray-200">
          <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label
                for="name"
                v-bind:class="
                  form.errors.name
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Name
              </label>
              <div class="mt-1">
                <input
                  id="name"
                  v-model="form.name"
                  :error="form.errors.name"
                  type="text"
                  v-bind:class="
                    form.errors.name
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.name" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="email"
                v-bind:class="
                  form.errors.email
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Email
              </label>
              <div class="mt-1">
                <input
                  id="email"
                  v-model="form.email"
                  :error="form.errors.email"
                  type="email"
                  v-bind:class="
                    form.errors.email
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.email" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="password"
                v-bind:class="
                  form.errors.password
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Password
              </label>
              <div class="mt-1">
                <input
                  id="password"
                  v-model="form.password"
                  :error="form.errors.password"
                  type="password"
                  v-bind:class="
                    form.errors.password
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.password"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="password_confirmation"
                v-bind:class="
                  form.errors.password_confirmation
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Confirm Password
              </label>
              <div class="mt-1">
                <input
                  id="password_confirmation"
                  v-model="form.password_confirmation"
                  :error="form.errors.password_confirmation"
                  type="password"
                  v-bind:class="
                    form.errors.password_confirmation
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.password_confirmation"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>
          </div>
        </div>

        <div class="pt-5">
          <progress
            v-if="form.progress"
            :value="form.progress.percentage"
            max="100"
          >
            {{ form.progress.percentage }}%
          </progress>
          <div class="flex justify-end">
            <Link
              class="
                rounded-md
                border border-gray-300
                bg-white
                py-2
                px-4
                text-sm
                font-medium
                text-gray-700
                shadow-sm
                hover:bg-gray-50
                focus:outline-none
                focus:ring-2
                focus:ring-gray-500
                focus:ring-offset-2
              "
              :href="route('users')"
            >
              Cancel
            </Link>
            <loading-button
              :loading="form"
              type="submit"
              class="
                ml-3
                inline-flex
                justify-center
                rounded-md
                border border-transparent
                bg-gray-600
                py-2
                px-4
                text-sm
                font-medium
                text-white
                shadow-sm
                hover:bg-gray-700
                focus:outline-none
                focus:ring-2
                focus:ring-gray-500
                focus:ring-offset-2
                disabled:bg-gray-300
              "
            >
              Save
            </loading-button>
          </div>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton.vue";
//import SelectInput from "@/Shared/SelectInput.vue";
import AppLayout from "@/Layouts/AppLayout";

export default {
  props: {
    client: Object,
    states: Object,
  },
  components: {
    AppLayout,
    LoadingButton,
    //SelectInput,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.route("users.store"));
    },
  },
};
</script>
