<template>
  <app-layout title="Media">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Media</h2>
    </template>
    <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
      <div class="relative">
        <div
          class="mb-6 grid grid-cols-2 gap-4 sm:flex sm:justify-items-stretch"
        >
          <div class="order-2 pr-4 sm:order-1 sm:w-1/6"></div>
          <div class="order-1 col-span-2 sm:order-2 sm:w-3/6 sm:pr-4"></div>
          <div class="order-3 sm:flex sm:w-2/6 sm:justify-end">
            <Link
              class="
                mt-1
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
                sm:ml-3
              "
              :href="route('media.create')"
            >
              Add Media
            </Link>
          </div>
        </div>
      </div>
      <div
        class="
          mt-6
          grid grid-cols-1
          gap-y-10 gap-x-6
          sm:grid-cols-2
          lg:grid-cols-4
          xl:gap-x-8
        "
      ></div>
      <div
        class="w-full text-center font-md text-sm"
        v-show="!mediaList.data.length"
      >
        No Media found with that search criteria.
      </div>
      <div class="overflow-x-auto rounded-md shadow">
        <div class="flex flex-col">
          <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
              <div class="overflow-hidden shadow">
                <input ref="sort_by" type="hidden" v-model="form.sort_by" />
                <input
                  ref="sort_direction"
                  type="hidden"
                  v-model="form.sort_direction"
                />
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th
                        scope="col"
                        class="
                          px-6
                          py-3
                          text-left text-xs
                          font-medium
                          uppercase
                          tracking-wider
                          text-gray-500
                        "
                      >
                        <span @click="sortTable('title')">
                          Title
                          <link
                            v-show="form.sort_by === 'title'"
                            :name="form.sort_direction_icon"
                          />
                          <link
                            v-if="!form.sort_by || form.sort_by !== 'title'"
                            :name="'sort'"
                          />
                        </span>
                      </th>
                      <th
                        scope="col"
                        class="
                          px-6
                          py-3
                          text-xs
                          font-medium
                          uppercase
                          tracking-wider
                          text-gray-500
                        "
                      >
                        <span @click="sortTable('url')">
                          Url
                          <Link
                            v-show="form.sort_by === 'url'"
                            :name="form.sort_direction_icon"
                          />
                          <Link
                            v-if="!form.sort_by || form.sort_by !== 'url'"
                            :name="'sort'"
                          />
                        </span>
                      </th>

                      <th
                        scope="col"
                        class="
                          px-6
                          py-3
                          text-xs
                          font-medium
                          uppercase
                          tracking-wider
                          text-gray-500
                        "
                      >
                        <span @click="sortTable('status')">
                          Status
                          <Link
                            v-show="form.sort_by === 'status'"
                            :name="form.sort_direction_icon"
                          />
                          <Link
                            v-if="!form.sort_by || form.sort_by !== 'status'"
                            :name="'sort'"
                          />
                        </span>
                      </th>
                      <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(media, index) in mediaList.data"
                      :key="index"
                      :class="
                        index % 2 === 0
                          ? 'bg-gray-50 hover:bg-gray-100'
                          : 'bg-white hover:bg-gray-100'
                      "
                    >
                      <td
                        class="
                          whitespace-nowrap
                          px-6
                          py-4
                          text-sm
                          font-medium
                          text-gray-900
                        "
                      >
                        {{ media.title }}
                      </td>
                      <td
                        class="
                          whitespace-nowrap
                          px-6
                          py-4
                          text-center text-sm text-gray-500
                        "
                      >
                        {{ media.url }}
                      </td>

                      <td
                        class="
                          whitespace-nowrap
                          px-6
                          py-4
                          text-center text-sm text-gray-500
                        "
                      >
                        <span
                          v-if="media.status == 1"
                          class="
                            text-xs
                            px-2
                            py-0.5
                            rounded
                            font-bold
                            bg-green-500
                            text-white
                          "
                        >
                          Active
                        </span>
                        <span
                          v-if="media.status == 0"
                          class="
                            text-xs
                            px-2
                            py-0.5
                            rounded
                            font-bold
                            bg-red-500
                            text-white
                          "
                        >
                          Inactive
                        </span>
                      </td>
                      <td
                        class="
                          whitespace-nowrap
                          px-6
                          py-4
                          text-right text-sm
                          font-medium
                        "
                      >
                        <Link
                          :href="route('media.edit', media.id)"
                          class="text-indigo-600 hover:text-indigo-900"
                        >
                          Edit
                        </Link>
                      </td>
                    </tr>
                    <tr v-show="!mediaList.data.length">
                      <td
                        colspan="5"
                        class="
                          whitespace-nowrap
                          px-6
                          py-4
                          text-center text-sm
                          font-medium
                        "
                      >
                        No Media were found.
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <pagination
        class="mt-6"
        :links="media.links"
        :results="media"
        :type="'media'"
      /> -->
    </div>
  </app-layout>
</template>

<script>
import Icon from "@/Shared/Icon";
import AppLayout from "@/Layouts/AppLayout";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";
import Pagination from "@/Shared/Pagination";
import pickBy from "lodash/pickBy";

export default {
  components: {
    Icon,
    Pagination,
    throttle,
    AppLayout,
  },
  props: {
    filters: Object,
    mediaList: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        paginate: this.filters.paginate ? this.filters.paginate : 2,
        sort_by: this.filters.sort_by,
        sort_direction_icon:
          this.filters.sort_direction === "desc" ? "sort-up" : "sort-down",
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(this.route("media"), pickBy(this.form), {
          preserveState: true,
        });
      }, 150),
    },
  },
  methods: {
    sortTable(column) {
      this.form.sort_by = column;
      this.form.sort_direction =
        this.form.sort_direction === "desc" ? "asc" : "desc";
      this.form.sort_direction_icon =
        this.form.sort_direction === "desc" ? "sort-up" : "sort-down";
    },
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
};
</script>
