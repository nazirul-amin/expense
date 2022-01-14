<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('incomes')">Incomes</inertia-link>
            </ol>
        </template>
        <div class="flex justify-end mb-6">
            <inertia-link class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg" :href="route('incomes.create')">
                New Income
            </inertia-link>
        </div>
        <div class="flex flex-col hidden lg:block">
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
                                        Account
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
                                <tr v-for="income in incomes.data" :key="income.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ income.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ income.account.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        RM {{ income.total }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ income.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ income.updated_at }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('incomes.edit', income.id)">
                                            <i class="las la-edit text-green-500">Edit</i>
                                        </inertia-link>
                                    </td>
                                </tr>

                                <tr v-if="incomes.data.length === 0">
                                    <td class="border-t px-6 py-5" colspan="6">No incomes found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="incomes.data.length" class="container mx-auto w-full h-full lg:hidden">
            <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div v-for="income in incomes.data" :key="income.id" class="flex-grow flex px-6 py-6 text-grey-darker items-center border-b -mx-4">
                    <div class="w-2/5 px-4 flex items-center">
                        <span class="text-lg">{{ income.name }}</span>
                    </div>
                    <div class="flex w-3/5">
                        <div class="w-1/2 px-4">
                            <div class="text-right text-grey">{{ income.total }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div v-if="!incomes.data.length" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between lg:hidden">
            <h2>No incomes found.</h2>
        </div>

        <div class="hidden lg:block">
            <pagination v-if="incomes.data.length" :data="incomes"></pagination>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'

    export default {
        metaInfo: { title: 'incomes' },
        components: {
            AppLayout,
            Welcome,
            Pagination,
        },
        props: {
            incomes: Object,
        },
    }
</script>
