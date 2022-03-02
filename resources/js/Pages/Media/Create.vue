<template>
  <app-layout title="Add Media">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add Media
      </h2>
    </template>
    <form @submit.prevent="store" class="space-y-2 divide-y divide-gray-200">
      <div class="bg-white min-h-screen flex items-center justify-center">
        <div class="grid grid-cols-12 gap-2">
          <div class="p-3 mt-2 text-right col-span-3">
            Title<span style="color: red">*</span>
          </div>
          <div class="p-3 col-span-9">
            <input
              id="title"
              v-model="form.title"
              :error="form.errors.title"
              type="text"
              v-bind:class="
                form.errors.title
                  ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                  : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
              "
            />
          </div>

          <div class="p-3 mt-2 text-right col-span-3">Url</div>
          <div class="p-3 col-span-9">
            <input
              id="url"
              v-model="form.url"
              :error="form.errors.url"
              type="text"
              placeholder="https://www.youtube.com/embed/xxxxxxxxx"
              v-bind:class="
                form.errors.url
                  ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                  : 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md'
              "
            />
            <p v-text="form.errors.url" class="text-sm text-red-500"></p>
          </div>

          <div class="p-3 mt-2 text-right col-span-3">Description</div>
          <div class="p-3 col-span-9">
            <textarea
              id="description"
              v-model="form.description"
              :error="form.errors.description"
              rows="5"
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

          <div class="p-3 mt-2 text-right col-span-3">Status</div>
          <div class="p-3 col-span-9">
            <select
              v-model="form.status"
              :error="form.errors.status"
              v-bind:class="
                form.errors.status
                  ? 'shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-red-300 rounded-md'
                  : 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm'
              "
            >
              <option v-for="obj in statusList" :key="obj.id" :value="obj.id">
                {{ obj.name }}
              </option>
            </select>

            <p v-text="form.errors.status" class="text-sm text-red-500"></p>
          </div>

          <div class="p-3 mt-2 text-right col-span-12">
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
              Save Changes
            </loading-button>
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
        <div class="flex justify-end"></div>
      </div>
    </form>
  </app-layout>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton.vue";
//import SelectInput from "@/Shared/SelectInput.vue";
import AppLayout from "@/Layouts/AppLayout";

export default {
  props: {
    mediaObj: Object,
    statusList: Object,
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
        title: null,
        url: null,
        description: null,
        status: 1,
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.route("media.store"));
    },
  },
};
</script>
