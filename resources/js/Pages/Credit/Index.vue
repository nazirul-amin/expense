<template>
    <app-layout>
        <div class="flex justify-end mb-6">
            <inertia-link class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg" :href="route('credits.create')">
                New Expense
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
                                        Pay With
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
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
                                <tr v-for="credit in credits.data" :key="credit.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ credit.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ credit.account.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ credit.total }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ credit.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ credit.updated_at }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('credits.edit', credit.id)">
                                            <i class="las la-edit text-green-500">Edit</i>
                                        </inertia-link>
                                    </td>
                                </tr>

                                <tr v-if="credits.data.length === 0">
                                    <td class="border-t px-6 py-5" colspan="6">No credits found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="credit in credits.data" :key="credit.id" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <div class="flex flex-col flex-grow">
                <h2>{{ credit.name }}</h2>
                <h3>Pay with : {{ credit.account.name }}</h3>
                <div><strong>Total : </strong>RM {{ credit.total }}</div>
                <div><strong>Created at : </strong>RM {{ credit.created_at }}</div>
                <div><strong>Updated at : </strong>RM {{ credit.updated_at }}</div>
                <div class="flex justify-end mt-6">
                    <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('credits.edit', credit.id)">
                        <i class="las la-edit text-green-500">Edit</i>
                    </inertia-link>
                </div>
            </div>
        </div>
        <pagination :data="credits"></pagination>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'

    export default {
        metaInfo: { title: 'credits' },
        components: {
            AppLayout,
            Welcome,
            Pagination,
        },
        props: {
            credits: Object,
        },
    }
</script>
