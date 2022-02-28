<template>
  <app-layout title="Edit Media">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit Media - {{ mediaobj.title }}
      </h2>
    </template>
    <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
      <form @submit.prevent="update" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-8 divide-y divide-gray-200">
          <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
              <label
                for="title"
                v-bind:class="
                  form.errors.title
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Title
              </label>
              <div class="mt-1">
                <input
                  id="title"
                  v-model="form.title"
                  :error="form.errors.title"
                  type="text"
                  v-bind:class="
                    form.errors.title
                      ? 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.title" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-3">
              <label
                for="title"
                v-bind:class="
                  form.errors.title
                    ? 'block text-sm font-medium text-red-500'
                    : 'block text-sm font-medium text-gray-700'
                "
              >
                Title
              </label>
              <div class="mt-1">
                <input
                  id="url"
                  v-model="form.url"
                  :error="form.errors.url"
                  type="text"
                  v-bind:class="
                    form.errors.url
                      ? 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p v-text="form.errors.url" class="text-sm text-red-500"></p>
              </div>
            </div>

            <div class="sm:col-span-3">
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
                  v-bind:class="
                    form.errors.description
                      ? 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
                <p
                  v-text="form.errors.description"
                  class="text-sm text-red-500"
                ></p>
              </div>
            </div>

            <div class="sm:col-span-3">
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
                <input
                  id="status"
                  v-model="form.status"
                  :error="form.errors.status"
                  type="text"
                  v-bind:class="
                    form.errors.status
                      ? 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-red-300 rounded-md'
                      : 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md'
                  "
                />
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
                @click="deleteMedia"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Delete Media
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
                  :href="route('media')"
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
//import axios from "axios";
//import { useForm } from "@inertiajs/inertia-vue3";
//import JetCheckbox from "@/Jetstream/Checkbox";
import JetDangerButton from "@/Jetstream/DangerButton";

export default {
  props: {
    mediaobj: Object,
  },
  components: {
    AppLayout,
    LoadingButton,
    // SelectInput,
    //JetCheckbox,
    JetDangerButton,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        _method: "put",
        title: this.mediaobj.title,
        url: this.mediaobj.url,
        description: this.mediaobj.description,
        status: this.mediaobj.status,
      }),
    };
  },
  methods: {
    update() {
      this.form.post(this.route("media.update", this.mediaobj.id));
    },

    deleteMedia() {
      this.form.delete(this.route("media.destroy", this.mediaobj), {
        errorBag: "deleteMedia",
      });
    },
  },
};
</script>
