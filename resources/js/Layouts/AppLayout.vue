<template>
    <div>
        <jet-banner />

        <div class="min-h-screen">

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow md:hidden" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header> -->



            <!-- Page Content -->
            <main class="md:mt-5 flex justify-center items-center bg-blue-secondary w-full md:w-3/5 z-10 md:rounded-3xl mx-auto" style="backdrop-filter: blur(2rem);height: 600px;">
                <nav class="bg-blue-light fixed top-20 md:top-36">
                    <!-- Primary Navigation Menu -->
                    <div id="primary_nav_menu" class="max-w-7xl md:max-w-none mx-auto px-4 px-8">
                        <div class="flex justify-center h-16 md:h-24">
                            <div class="flex">
                                <!-- Logo -->
                                <!-- <div class="flex-shrink-0 flex items-center">
                                    <inertia-link :href="route('dashboard')">
                                        <jet-application-mark class="block h-9 w-auto" />
                                    </inertia-link>
                                </div> -->

                                <!-- Navigation Links -->
                                <div class="space-x-1 flex">
                                    <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                        <img class="md:hidden" src="/images/home_30px.png">
                                        <img class="hidden md:block" src="/images/home_48px.png">
                                    </jet-nav-link>
                                    <jet-nav-link :href="route('accounts')" :active="route().current('accounts')">
                                        <img class="md:hidden" src="/images/money_bag_30px.png">
                                        <img class="hidden md:block" src="/images/money_bag_48px.png">
                                    </jet-nav-link>
                                    <jet-nav-link :href="route('expenses')" :active="route().current('expenses')">
                                        <img class="md:hidden" src="/images/transaction_30px.png">
                                        <img class="hidden md:block" src="/images/transaction_48px.png">
                                    </jet-nav-link>
                                    <jet-nav-link :href="route('incomes')" :active="route().current('incomes')">
                                        <img class="md:hidden" src="/images/get_cash_30px.png">
                                        <img class="hidden md:block" src="/images/get_cash_48px.png">
                                    </jet-nav-link>
                                    <jet-dropdown class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <template #trigger>
                                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                            </button>

                                            <a v-else href="#">
                                                <img class="md:hidden" src="/images/user_30px.png">
                                                <img class="hidden md:block" src="/images/user_48px.png">
                                            </a>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ $page.props.user.name }}
                                            </div>

                                            <jet-dropdown-link :href="route('profile.show')">
                                                Profile
                                            </jet-dropdown-link>

                                            <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                                API Tokens
                                            </jet-dropdown-link>

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <jet-dropdown-link as="button">
                                                    Log Out
                                                </jet-dropdown-link>
                                            </form>
                                        </template>
                                    </jet-dropdown>
                                    <!-- <jet-nav-link :href="route('credits')" :active="route().current('credits')">
                                        Credit
                                    </jet-nav-link> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- <nav class="bg-white shadow max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 md:hidden">
                    <slot name="header"></slot>
                </nav> -->
                <section class="mt-60 lg:mt-0">
                    <div class="m-8">
                        <div class="cards" style="z-index: 3">
                            <slot></slot>
                        </div>
                    </div>
                </section>
            </main>
            <!-- <div class="circle1"></div>
            <div class="circle2"></div> -->
        </div>
    </div>
</template>

<style scoped>
    main::before {
        content: "";
        background-color: white;
        transform: translate(0, 20%);
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: -1;
    }
    @media only screen and (min-width: 768px) {
        main {
            min-height: 90vh;
            height: 100%;
        }
        #primary_nav_menu {
            width: 600px;
        }
    }
</style>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
