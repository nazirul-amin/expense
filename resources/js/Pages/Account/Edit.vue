<template>
    <app-layout>
        <form @submit.prevent="update" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="account_name" value="Account Name" />
                <jet-input id="account_name" type="text" class="mt-1 block w-full" v-model="form.account_name" ref="account_name" autocomplete="off" />
                <div v-if="errors.account_name" class="text-red-500">{{ errors.account_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="account_balance" value="Account Balance" />
                <jet-input id="account_balance" type="text" class="mt-1 block w-full" v-model="form.account_balance" ref="account_balance" autocomplete="off" />
                <div v-if="errors.account_balance" class="text-red-500">{{ errors.account_balance }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="account_type" value="Account Type" />
                <select id="account_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.account_type">
                    <option value="">Please Choose</option>
                    <option value="1">Cash</option>
                    <option value="2">Bank</option>
                    <option value="3">Credit</option>
                </select>
                <div v-if="errors.account_type" class="text-red-500">{{ errors.account_type }}</div>
            </div>

            <jet-action-message :on="form.recentlySuccessful" class="mt-2 mr-3">
                Updated.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" class="mt-2" :disabled="form.processing">
                Update
            </jet-button>
        </form>
        <div class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <jet-button @click="destroy" :type="button" :class="{ 'opacity-25': form.processing }" class="mt-2 bg-red-600 hover:bg-red-500 active:bg-red-600 focus:border-red-600 focus:shadow-outline-red" :disabled="form.processing">
                Delete
            </jet-button>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        metaInfo() {
            return { title: this.form.name }
        },
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetActionMessage,
        },
        props: {
            account: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    account_name: this.account.account_name,
                    account_balance: this.account.account_balance,
                    account_type: this.account.account_type,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(this.route('accounts.update', this.account.id))
            },
            destroy() {
                if (confirm('Are you sure you want to delete this account?')) {
                    this.$inertia.delete(this.route('accounts.destroy', this.account.id))
                }
            },
        },
    }
</script>
