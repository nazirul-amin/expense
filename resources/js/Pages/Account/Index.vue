<template>
    <app-layout>
        <div class="flex justify-end mb-6">
            <inertia-link class="rounded-xl text-sm text-center font-bold text-indigo-100 transition-colors duration-150 bg-indigo-700 p-4 whitespace-nowrap w-full md:w-auto" :href="route('accounts.create')">
                New Account
            </inertia-link>
        </div>
        <div class="flex flex-col hidden md:block">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Balance
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Updated At
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="account in accounts.data" :key="account.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ account.name }}</div>
                                        <div class="text-sm text-gray-500">{{ account.type_id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ account.balance }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ account.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ account.updated_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900" :href="route('accounts.destroy', account.id)">
                                            <i class="las la-trash text-red-500">Delete</i>
                                        </inertia-link>
                                    </td>
                                </tr>

                                <tr v-if="accounts.data.length === 0">
                                    <td class="border-t px-6 py-4" colspan="4">No accounts found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="account in accounts.data" :key="account.id" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <div class="flex flex-col flex-grow">
                <h2>{{ account.name }}</h2>
                <h3>{{ account.type_id }}</h3>
                <div><strong>Total : </strong>RM {{ account.balance }}</div>
                <div><strong>Total : </strong>RM {{ account.created_at }}</div>
                <div><strong>Total : </strong>RM {{ account.updated_at }}</div>
                <div class="flex justify-end mt-6">
                    <a href="#" class="text-right"><i class="las la-trash text-red-500">Delete</i></a>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'

    export default {
        metaInfo: { title: 'Accounts' },
        components: {
            AppLayout,
            Welcome,
            Pagination,
        },
        props: {
            accounts: Object,
        },
    }
</script>
