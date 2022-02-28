<template>
    <div>
        <portal-target name="dropdown" slim />
        <div class="md:flex md:flex-col">
            <div class="md:flex md:h-screen md:flex-col">
                <div class="md:flex md:flex-shrink-0">
                    <div
                        class="flex items-center justify-between bg-indigo-900 px-6 py-4 md:w-56 md:flex-shrink-0 md:justify-center"
                    >
                        <inertia-link class="mt-1" href="/">
                            <logo class="fill-white" width="120" height="28" />
                        </inertia-link>
                        <dropdown class="md:hidden" placement="bottom-end">
                            <svg
                                class="h-6 w-6 fill-white"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                                />
                            </svg>
                            <div
                                slot="dropdown"
                                class="mt-2 rounded bg-indigo-800 px-8 py-4 shadow-lg"
                            >
                                <main-menu />
                            </div>
                        </dropdown>
                    </div>
                    <div
                        class="md:text-md flex w-full items-center justify-between border-b bg-white p-4 text-sm md:py-0 md:px-12"
                    >
                        <div class="mt-1 mr-4">
                            {{ $page.props.auth.user.first_name }}
                        </div>
                        <dropdown class="mt-1" placement="bottom-end">
                            <div
                                class="group flex cursor-pointer select-none items-center"
                            >
                                <div
                                    class="mr-1 whitespace-nowrap text-gray-700 focus:text-indigo-600 group-hover:text-indigo-600"
                                >
                                    <span>{{
                                        $page.props.auth.user.first_name
                                    }}</span>
                                    <span class="hidden md:inline">{{
                                        $page.props.auth.user.last_name
                                    }}</span>
                                </div>
                                <icon
                                    class="h-5 w-5 fill-gray-700 focus:fill-indigo-600 group-hover:fill-indigo-600"
                                    name="cheveron-down"
                                />
                            </div>
                            <div
                                slot="dropdown"
                                class="mt-2 rounded bg-white py-2 text-sm shadow-xl"
                            >
                                <inertia-link
                                    class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
                                    :href="
                                        route(
                                            'users.edit',
                                            $page.props.auth.user.id
                                        )
                                    "
                                    >My Profile</inertia-link
                                >
                                <inertia-link
                                    class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
                                    :href="
                                        route(
                                            'users.subscription',
                                            $page.props.auth.user.id
                                        )
                                    "
                                    >My Subscription</inertia-link
                                >
                                <inertia-link
                                    class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
                                    :href="route('users')"
                                    >Manage Users</inertia-link
                                >
                                <inertia-link
                                    class="block w-full px-6 py-2 text-left hover:bg-indigo-500 hover:text-white"
                                    :href="route('logout')"
                                    method="delete"
                                    as="button"
                                    >Logout</inertia-link
                                >
                            </div>
                        </dropdown>
                    </div>
                </div>
                <div class="md:flex md:flex-grow md:overflow-hidden">
                    <main-menu
                        class="hidden w-56 flex-shrink-0 overflow-y-auto bg-indigo-800 p-12 md:block"
                    />
                    <div
                        class="px-4 py-8 md:flex-1 md:overflow-y-auto md:p-12"
                        scroll-region
                    >
                        <flash-messages />
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Icon from "@/Shared/Icon";
import Logo from "@/Shared/Logo";
import Dropdown from "@/Shared/Dropdown";
import MainMenu from "@/Shared/MainMenu";
import FlashMessages from "@/Shared/FlashMessages";

export default {
    components: {
        Dropdown,
        FlashMessages,
        Icon,
        Logo,
        MainMenu,
    },
};
</script>
