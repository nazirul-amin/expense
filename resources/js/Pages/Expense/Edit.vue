<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('expenses')">Expenses</inertia-link>
                <li><span class="mx-2">/</span></li>
                <inertia-link class="" href="">Edit</inertia-link>
            </ol>
        </template>
        <form @submit.prevent="update" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="expense_name" value="Expense Name" />
                <jet-input id="expense_name" type="text" class="mt-1 block w-full" v-model="form.expense_name" autocomplete="off" />
                <div v-if="errors.expense_name" class="text-red-500">{{ errors.expense_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="expense_total" value="Expense Total" />
                <jet-input id="expense_total" type="text" class="mt-1 block w-full" v-model="form.expense_total" readonly="true" autocomplete="off" />
            </div>

            <div class="mt-2">
                <jet-label for="pay_with" value="Pay With" />
                <select id="pay_with" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.pay_with">
                    <option value="">Please Choose</option>
                    <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                </select>
                <div v-if="errors.pay_with" class="text-red-500">{{ errors.pay_with }}</div>
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
            accounts: Object,
            expense: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    expense_name: this.expense.expense_name,
                    expense_total: this.expense.expense_total,
                    pay_with: this.expense.pay_with,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(this.route('expenses.update', this.expense.id))
            },
            destroy() {
                if (confirm('Are you sure you want to delete this expense?')) {
                    this.$inertia.delete(this.route('expenses.destroy', this.expense.id))
                }
            },
        },
    }
</script>
