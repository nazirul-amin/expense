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
                                        {{ income.total }}
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
        <div v-for="income in incomes.data" :key="income.id" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <div class="flex flex-col flex-grow">
                <h2>{{ income.name }}</h2>
                <h3>Account : {{ income.account.name }}</h3>
                <div><strong>Total : </strong>RM {{ income.total }}</div>
                <div><strong>Created at : </strong>RM {{ income.created_at }}</div>
                <div><strong>Updated at : </strong>RM {{ income.updated_at }}</div>
                <div class="flex justify-end mt-6">
                    <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('incomes.edit', income.id)">
                        <i class="las la-edit text-green-500">Edit</i>
                    </inertia-link>
                </div>
            </div>
        </div>
        <pagination :data="incomes"></pagination>
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
