<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('transactions')">Transactions</inertia-link>
                <li><span class="mx-2">/</span></li>
                <inertia-link class="" href="">Create</inertia-link>
            </ol>
        </template>
        <form @submit.prevent="store" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="transaction_name" value="Transaction Name" />
                <jet-input id="transaction_name" type="text" class="mt-1 block w-full" v-model="form.transaction_name" ref="transaction_name" autocomplete="off" />
                <div v-if="errors.transaction_name" class="text-red-500">{{ errors.transaction_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="transaction_total" value="Transaction Total" />
                <jet-input id="transaction_total" type="text" class="mt-1 block w-full" v-model="form.transaction_total" ref="transaction_total" autocomplete="off" />
                <div v-if="errors.transaction_total" class="text-red-500">{{ errors.transaction_total }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="transaction_type" value="Transaction Type" />
                <select id="transaction_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.transaction_type">
                    <option value="">Please Choose</option>
                    <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                </select>
                <div v-if="errors.account" class="text-red-500">{{ errors.type }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="transaction_account" value="Account" />
                <select id="transaction_account" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.transaction_account">
                    <option value="">Please Choose</option>
                    <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                </select>
                <div v-if="errors.account" class="text-red-500">{{ errors.type }}</div>
            </div>

            <jet-action-message :on="form.recentlySuccessful" class="mt-2 mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" class="mt-2" :disabled="form.processing">
                Save
            </jet-button>
        </form>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        metaInfo: { title: 'Add New Transaction' },
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetActionMessage,
        },
        props: {
            types: Object,
            accounts: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    transaction_name: '',
                    transaction_total: '',
                    transaction_type: '',
                    transaction_account: '',
                }),
            }
        },
        methods: {
            store() {
                this.form.post(this.route('transactions.store'), {
                    onSuccess: () => this.form.reset(),
                })
            },
        },
    }
</script>
