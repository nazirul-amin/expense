<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('accounts')">Accounts</inertia-link>
            </ol>
        </template>
        <div class="flex justify-end mb-6">
            <inertia-link class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg" :href="route('account.create')">
                New Account
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
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900" :href="route('account.show', account.id)">
                                            <div class="text-sm text-gray-900">{{ account.name }}</div>
                                        </inertia-link>
                                        <div v-if="account.type_id==1" class="text-sm text-gray-500">Cash</div>
                                        <div v-if="account.type_id==2" class="text-sm text-gray-500">Bank</div>
                                        <div v-if="account.type_id==3" class="text-sm text-gray-500">Card</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        RM {{ account.balance }}
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
                                    <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('account.edit', account.id)">
                                            <i class="las la-edit text-green-500">Edit</i>
                                        </inertia-link>
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900" href="" @click="destroy(account.id)">
                                            <i class="las la-trash text-red-500">Delete</i>
                                        </inertia-link>
                                    </td>
                                </tr>

                                <tr v-if="accounts.data.length === 0">
                                    <td class="border-t px-6 py-4" colspan="6">No accounts found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div v-for="account in accounts.data" :key="account.id" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <div class="flex flex-col flex-grow">
                <h2>{{ account.name }}</h2>
                <h3 v-if="account.type_id==1">Cash</h3>
                <h3 v-if="account.type_id==2">Bank</h3>
                <h3 v-if="account.type_id==3">Card</h3>
                <div><strong>Balance : </strong>RM {{ account.balance }}</div>
                <div><strong>Created : </strong>RM {{ account.created_at }}</div>
                <div><strong>Updated : </strong>RM {{ account.updated_at }}</div>
                <div class="flex justify-end mt-6">
                    <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('account.edit', account.id)">
                        <i class="las la-edit text-green-500">Edit</i>
                    </inertia-link>
                    <inertia-link class="text-indigo-600 hover:text-indigo-900" href="" @click="destroy(account.id)">
                        <i class="las la-trash text-red-500">Delete</i>
                    </inertia-link>
                </div>
            </div>
        </div> -->

        <div v-for="account in accounts.data" class="lg:hidden" style="transition: var(--transition); transition-delay: var(--transitionDelay2); background-color: white; border-radius: 5px; box-shadow: 0px 0px 8px 4px rgba(0, 0, 0, 0.03); overflow: hidden; margin-top: 30px;">
            <div style="padding-left: 20px;padding-top: 20px;padding-right: 20px;display: flex;justify-content: space-between;align-items: center;">
                <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('account.show', account.id)">
                    <strong style="font-size: 20px;">{{ account.name }}</strong>
                </inertia-link>
                <span v-if="account.type_id==1" style="font-size: 14px;background-color: #dde2e7;padding: 4px 11px;border-radius: 20px;font-weight: 700;color: #5f6061;">Cash</span>
                <span v-if="account.type_id==2" style="font-size: 14px;background-color: #dde2e7;padding: 4px 11px;border-radius: 20px;font-weight: 700;color: #5f6061;">Bank</span>
                <span v-if="account.type_id==3" style="font-size: 14px;background-color: #dde2e7;padding: 4px 11px;border-radius: 20px;font-weight: 700;color: #5f6061;">Card</span>
            </div>
            <div style="padding: 20px; text-align: center;">
                <div><strong>Balance : </strong>RM {{ account.balance }}</div>
                <div><strong>Created : </strong>RM {{ account.created_at }}</div>
                <div><strong>Updated : </strong>RM {{ account.updated_at }}</div>
            </div>
            <div style="padding: 20px;background-color: #f8f8f8;display: flex;justify-content: space-between;align-items: center;">
                <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('account.edit', account.id)">
                    <i class="las la-edit text-green-500">Edit</i>
                </inertia-link>
                <inertia-link class="text-indigo-600 hover:text-indigo-900" href="" @click="destroy(account.id)">
                    <i class="las la-trash text-red-500">Delete</i>
                </inertia-link>
            </div>
        </div>
        <div v-if="!accounts.data.length" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between lg:hidden">
            <h2>No accounts found.</h2>
        </div>
        <pagination v-if="accounts.data.length" :data="accounts"></pagination>
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
        methods: {
            destroy(id) {
                if (confirm('Are you sure you want to delete this account?')) {
                    this.$inertia.delete(this.route('account.destroy', id))
                }
            },
        }
    }
</script>
