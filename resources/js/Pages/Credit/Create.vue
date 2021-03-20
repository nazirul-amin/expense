<template>
    <app-layout>
        <form @submit.prevent="store" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="expense_name" value="Expense Name" />
                <jet-input id="expense_name" type="text" class="mt-1 block w-full" v-model="form.expense_name" ref="expense_name" autocomplete="off" />
                <div v-if="errors.expense_name" class="text-red-500">{{ errors.expense_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="expense_total" value="Expense Total" />
                <jet-input id="expense_total" type="text" class="mt-1 block w-full" v-model="form.expense_total" ref="expense_total" autocomplete="off" />
                <div v-if="errors.expense_total" class="text-red-500">{{ errors.expense_total }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="pay_with" value="Pay with" />
                <select id="pay_with" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.pay_with">
                    <option value="">Please Choose</option>
                    <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                </select>
                <div v-if="errors.pay_with" class="text-red-500">{{ errors.pay_with }}</div>
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
        metaInfo: { title: 'Add New Expense' },
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetActionMessage,
        },
        props: {
            accounts: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    expense_name: '',
                    expense_total: '',
                    pay_with: '',
                }),
            }
        },
        methods: {
            store() {
                this.form.post(this.route('expenses.store'), {
                    onSuccess: () => this.form.reset(),
                })
            },
        },
    }
</script>
