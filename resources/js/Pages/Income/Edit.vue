<template>
    <app-layout>
        <form @submit.prevent="update" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="income_name" value="Income Name" />
                <jet-input id="income_name" type="text" class="mt-1 block w-full" v-model="form.income_name" autocomplete="off" />
                <div v-if="errors.income_name" class="text-red-500">{{ errors.income_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="income_total" value="Income Total" />
                <jet-input id="income_total" type="text" class="mt-1 block w-full" v-model="form.income_total" readonly="true" autocomplete="off" />
            </div>

            <div class="mt-2">
                <jet-label for="account" value="Pay With" />
                <select id="account" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.account">
                    <option value="">Please Choose</option>
                    <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                </select>
                <div v-if="errors.account" class="text-red-500">{{ errors.account }}</div>
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
            income: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    income_name: this.income.income_name,
                    income_total: this.income.income_total,
                    account: this.income.account,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(this.route('incomes.update', this.income.id))
            },
            destroy() {
                if (confirm('Are you sure you want to delete this income?')) {
                    this.$inertia.delete(this.route('incomes.destroy', this.income.id))
                }
            },
        },
    }
</script>
