<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('transactions')">transactions</inertia-link>
            </ol>
        </template>
        <div class="flex justify-end mb-6">
            <inertia-link class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg" :href="route('transactions.create')">
                New Transaction
            </inertia-link>
        </div>
        <div class="flex flex-col hidden lg:block">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 10%">
                                        Date
                                    </th>
                                    <th v-if="route().current('transactions')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 10%">
                                        Account
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 60%">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 20%">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="transaction in transactions.data" :key="transaction.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-grey-500">
                                        {{ transaction.updated_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-grey-500">
                                        {{ transaction.account.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-grey-500">
                                        {{ transaction.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" :class="transaction.transaction_type == 'Income' ? 'text-green-500' : 'text-red-500'">
                                        RM {{ transaction.total }}
                                    </td>
                                </tr>

                                <tr v-if="transactions.data.length === 0">
                                    <td class="border-t px-6 py-5" colspan="6">No transactions found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="transactions.data.length" class="container mx-auto w-full h-full lg:hidden">
            <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                <div v-for="transaction in transactions.data" :key="transaction.id" class="flex-grow flex px-6 py-6 text-grey-darker items-center border-b -mx-4">
                    <div class="w-2/5 px-4 flex items-center">
                        <span class="text-lg">{{ transaction.name }}</span>
                    </div>
                    <div class="flex w-3/5">
                        <div class="w-1/2 px-4">
                            <div class="text-right text-grey">{{ transaction.total }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div v-if="!transactions.data.length" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between lg:hidden">
            <h2>No transactions found.</h2>
        </div>

        <div class="hidden lg:block">
            <pagination v-if="transactions.data.length" :data="transactions"></pagination>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'

    export default {
        metaInfo: { title: 'transactions' },
        components: {
            AppLayout,
            Welcome,
            Pagination,
        },
        props: {
            transactions: Object,
        }
    }
</script>
