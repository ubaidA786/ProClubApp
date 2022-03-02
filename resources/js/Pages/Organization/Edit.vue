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
            <div class="sm:col-span-2">
              <label
                for="name"
                v-bind:class="
                  form.errors.name
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Name<span style="color: red">*</span>
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
            <div class="sm:col-span-2">
              <label
                for="address_1"
                v-bind:class="
                  form.errors.address_1
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Address 1
              </label>
              <div class="mt-1">
                <textarea
                  id="address_1"
                  v-model="form.address_1"
                  :error="form.errors.address_1"
                  type="text"
                  v-bind:class="
                    form.errors.address_1
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.address_1"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="address_2"
                v-bind:class="
                  form.errors.address_2
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Address 2
              </label>
              <div class="mt-1">
                <textarea
                  id="address_2"
                  v-model="form.address_2"
                  :error="form.errors.address_2"
                  type="text"
                  v-bind:class="
                    form.errors.address_2
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.address_2"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="city"
                v-bind:class="
                  form.errors.city
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                City
              </label>
              <div class="mt-1">
                <input
                  id="city"
                  v-model="form.city"
                  :error="form.errors.city"
                  type="text"
                  v-bind:class="
                    form.errors.city
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.city" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="state"
                v-bind:class="
                  form.errors.state
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                State
              </label>
              <div class="mt-1">
                <input
                  id="title"
                  v-model="form.state"
                  :error="form.errors.state"
                  type="text"
                  v-bind:class="
                    form.errors.state
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.state" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="zip"
                v-bind:class="
                  form.errors.zip
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Zip
              </label>
              <div class="mt-1">
                <input
                  id="zip"
                  v-model="form.zip"
                  :error="form.errors.zip"
                  type="text"
                  v-bind:class="
                    form.errors.zip
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.zip" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="website"
                v-bind:class="
                  form.errors.website
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Website
              </label>
              <div class="mt-1">
                <input
                  id="website"
                  v-model="form.website"
                  :error="form.errors.website"
                  type="text"
                  v-bind:class="
                    form.errors.website
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.website"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="access_start_date"
                v-bind:class="
                  form.errors.access_start_date
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Access Start Date
              </label>
              <div class="mt-1">
                <input
                  id="access_start_date"
                  v-model="form.access_start_date"
                  :error="form.errors.access_start_date"
                  type="date"
                  min="2020-01-01"
                  max="2030-12-31"
                  v-bind:class="
                    form.errors.access_start_date
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.access_start_date"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="access_end_date"
                v-bind:class="
                  form.errors.access_end_date
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Access End Date
              </label>
              <div class="mt-1">
                <input
                  id="access_end_date"
                  v-model="form.access_end_date"
                  :error="form.errors.access_end_date"
                  type="date"
                  min="2020-01-01"
                  max="2030-12-31"
                  v-bind:class="
                    form.errors.access_end_date
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.access_end_date"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="ip_addresses"
                v-bind:class="
                  form.errors.ip_addresses
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                IP Address
              </label>
              <div class="mt-1">
                <textarea
                  id="ip_addresses"
                  v-model="form.ip_addresses"
                  :error="form.errors.ip_addresses"
                  type="text"
                  v-bind:class="
                    form.errors.ip_addresses
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.ip_addresses"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="passcode"
                v-bind:class="
                  form.errors.passcode
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Passcode
              </label>
              <div class="mt-1">
                <input
                  id="passcode"
                  v-model="form.passcode"
                  :error="form.errors.passcode"
                  type="text"
                  v-bind:class="
                    form.errors.passcode
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.passcode"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="media_id"
                v-bind:class="
                  form.errors.media_id
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Media
              </label>
              <div class="mt-1">
                <select
                  v-model="form.media_id"
                  :error="form.errors.media_id"
                  v-bind:class="
                    form.errors.media_id
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm'
                  "
                >
                  <option :value="null">--- Select Media ---</option>
                  <option v-for="med in media" :key="med.id" :value="med.id">
                    {{ med.title }}
                  </option>
                </select>
                <p
                  v-text="form.errors.media_id"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-2">
              <label
                for="description"
                v-bind:class="
                  form.errors.description
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Description
              </label>
              <div class="mt-1">
                <textarea
                  id="description"
                  v-model="form.description"
                  :error="form.errors.description"
                  type="text"
                  v-bind:class="
                    form.errors.description
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.description"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-1">
              <label
                for="status"
                v-bind:class="
                  form.errors.status
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Status
              </label>
              <div class="mt-1">
                <select
                  v-model="form.status"
                  :error="form.errors.status"
                  v-bind:class="
                    form.errors.status
                      ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm'
                  "
                >
                  <option
                    v-for="obj in statusList"
                    :key="obj.id"
                    :value="obj.id"
                  >
                    {{ obj.name }}
                  </option>
                </select>
                <p v-text="form.errors.status" class="text-sm text-red-500"></p>
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
                    focus:ring-gray-500
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
    statusList: Object,
    media: Array,
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
      this.form.delete(this.route("organization.destroy", this.organization), {
        errorBag: "deleteOrganization",
      });
    },
  },
};
</script>
