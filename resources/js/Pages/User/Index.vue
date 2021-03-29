<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('users')">Users</inertia-link>
            </ol>
        </template>
        <div class="flex justify-end mb-6">
            <inertia-link class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg" :href="route('users.create')">
                New user
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
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.name }}</div>
                                        <div v-if="user.type_id==1" class="text-sm text-gray-500">Cash</div>
                                        <div v-if="user.type_id==2" class="text-sm text-gray-500">Bank</div>
                                        <div v-if="user.type_id==3" class="text-sm text-gray-500">Card</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ user.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ user.updated_at }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('users.edit', user.id)">
                                            <i class="las la-edit text-green-500">Edit</i>
                                        </inertia-link>
                                        <inertia-link class="text-indigo-600 hover:text-indigo-900" href="" @click="destroy(user.id)">
                                            <i class="las la-trash text-red-500">Delete</i>
                                        </inertia-link>
                                    </td>
                                </tr>

                                <tr v-if="users.data.length === 0">
                                    <td class="border-t px-6 py-4" colspan="6">No users found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="user in users.data" :key="user.id" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <div class="flex flex-col flex-grow">
                <h2>{{ user.name }}</h2>
                <div><strong>Balance : </strong>RM {{ user.balance }}</div>
                <div><strong>Created : </strong>RM {{ user.created_at }}</div>
                <div><strong>Updated : </strong>RM {{ user.updated_at }}</div>
                <div class="flex justify-end mt-6">
                    <inertia-link class="text-indigo-600 hover:text-indigo-900 mr-6" :href="route('users.edit', user.id)">
                        <i class="las la-edit text-green-500">Edit</i>
                    </inertia-link>
                    <inertia-link class="text-indigo-600 hover:text-indigo-900" href="" @click="destroy(user.id)">
                        <i class="las la-trash text-red-500">Delete</i>
                    </inertia-link>
                </div>
            </div>
        </div>
        <div v-if="!users.data.length" class="flex bg-white rounded-2xl my-4 p-6 shadow-md justify-between md:hidden">
            <h2>No users found.</h2>
        </div>
        <pagination v-if="users.data.length" :data="users"></pagination>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout_admin'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'

    export default {
        metaInfo: { title: 'users' },
        components: {
            AppLayout,
            Welcome,
            Pagination,
        },
        props: {
            users: Object,
        },
        methods: {
            destroy(id) {
                if (confirm('Are you sure you want to delete this user?')) {
                    this.$inertia.delete(this.route('users.destroy', id))
                }
            },
        }
    }
</script>
