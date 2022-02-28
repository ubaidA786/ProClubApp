<template>
  <public-layout title="Default">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl" style="width: 100%; text-align: center">
              <h1
                class="font-semibold text-xl text-gray-800 leading-tight"
                style="font-size: 40px"
              >
                Protected: {{ data.name }}
              </h1>
              <div
                style="font-size: 16px; font-weight: bold; line-height: 22px"
              >
                <div>
                  The following video has been licensed for use by the
                  organizaiton above.
                </div>
                <div>
                  Any other unauthorized use of this video, whether private or
                  public,
                </div>
                <div>is expressly prohibited and punishable by law.</div>
              </div>
              <span v-if="data.url">
                <iframe
                  style="display: block; margin: 40px auto"
                  width="420"
                  height="315"
                  :src="data.url"
                >
                </iframe
              ></span>
              <span v-else>
                <div
                  class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                    relative
                  "
                  role="alert"
                >
                  <span class="block sm:inline">Media is not linked here.</span>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg
                      class="fill-current h-6 w-6 text-red-500"
                      role="button"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <title>Close</title>
                      <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                      />
                    </svg>
                  </span>
                </div>
              </span>
            </div>
          </div>
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
    data: Object,
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
