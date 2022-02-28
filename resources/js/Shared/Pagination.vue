<template>
  <div
    class="
      flex
      items-center
      justify-between
      border-t border-gray-200
      bg-white
      py-3
    "
  >
    <div class="flex flex-1 justify-between sm:hidden">
      <Link
        href="#"
        class="
          relative
          inline-flex
          items-center
          rounded-md
          border border-gray-300
          bg-white
          px-4
          py-2
          text-sm
          font-medium
          text-gray-700
          hover:bg-gray-50
        "
      >
        Previous
      </Link>
      <Link
        href="#"
        class="
          relative
          ml-3
          inline-flex
          items-center
          rounded-md
          border border-gray-300
          bg-white
          px-4
          py-2
          text-sm
          font-medium
          text-gray-700
          hover:bg-gray-50
        "
      >
        Next
      </Link>
    </div>
    <div
      v-show="results.total > 0"
      class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
    >
      <div>
        <p class="text-sm text-gray-700">
          Showing
          {{ " " }}
          <span class="font-medium">{{ results.from }}</span>
          {{ " " }}
          to
          {{ " " }}
          <span class="font-medium">{{ results.to }}</span>
          {{ " " }}
          of
          {{ " " }}
          <span class="font-medium">{{ results.total }}</span>
          {{ " " }}
          {{ type }}
        </p>
      </div>
      <div v-if="links.length > 3">
        <div class="-mb-1 flex flex-wrap">
          <template v-for="(link, key) in links">
            <div
              v-if="link.url === null"
              :key="key"
              class="
                mr-1
                mb-1
                rounded
                border
                px-4
                py-3
                text-sm
                leading-4
                text-gray-400
              "
              v-html="link.label"
            />
            <Link
              v-else
              class="
                mr-1
                mb-1
                rounded
                border
                px-4
                py-3
                text-sm
                leading-4
                hover:bg-white
                focus:border-indigo-500 focus:text-indigo-500
              "
              :class="{
                'z-10 border-indigo-500 bg-indigo-50 text-indigo-600':
                  link.active,
              }"
              :href="link.url"
              v-html="link.label"
              :key="link.url"
            />
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from "@vue-hero-icons/solid";

export default {
  props: {
    links: Array,
    type: null,
    results: Object,
  },
  components: {
    ChevronLeftIcon,
    ChevronRightIcon,
  },
};
</script>
