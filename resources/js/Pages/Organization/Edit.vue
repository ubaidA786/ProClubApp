<template>
  <app-layout title="Edit Organization">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit Organization - {{ organization.name }}
      </h2>
    </template>
    <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
      <form @submit.prevent="update" class="space-y-8 divide-y divide-gray-200">
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
                      ? 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.name" class="text-sm text-red-500"></p>
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
          <div class="flex">
            <div class="w-1/2">
              <jet-danger-button
                class="mr-3"
                @click="deleteOrganization"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Delete Organization
              </jet-danger-button>
            </div>
            <div class="w-1/2">
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
                    focus:ring-indigo-500
                    focus:ring-offset-2
                  "
                  :href="route('organizations')"
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
                    bg-indigo-600
                    py-2
                    px-4
                    text-sm
                    font-medium
                    text-white
                    shadow-sm
                    hover:bg-indigo-700
                    focus:outline-none
                    focus:ring-2
                    focus:ring-indigo-500
                    focus:ring-offset-2
                    disabled:bg-indigo-300
                  "
                >
                  Save
                </loading-button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </app-layout>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton.vue";
// import SelectInput from "@/Shared/SelectInput.vue";
import AppLayout from "@/Layouts/AppLayout";
import axios from "axios";
import { useForm } from "@inertiajs/inertia-vue3";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
  props: {
    organization: Object,
  },
  components: {
    AppLayout,
    LoadingButton,
    // SelectInput,
    JetCheckbox,
    JetDangerButton,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        _method: "put",
        name: this.organization.name,
        address_1: this.organization.address_1,
        address_2: this.organization.address_2,
        city: this.organization.city,
        state: this.organization.state,
        zip: this.organization.zip,
        website: this.organization.website,
        access_start_date: this.organization.access_start_date,
        access_end_date: this.organization.access_end_date,
        ip_addresses: this.organization.ip_addresses,
        passcode: this.organization.passcode,
        media_id: this.organization.media_id,
        description: this.organization.description,
        status: this.organization.status,
      }),
    };
  },
  methods: {
    update() {
      this.form.post(this.route("organization.update", this.organization.id));
    },

    deleteOrganization() {
      this.form.delete(this.route("organization.destroy", this.user), {
        errorBag: "deleteOrganization",
      });
    },
  },
};
</script>
