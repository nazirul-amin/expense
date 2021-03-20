<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('incomes')">Incomes</inertia-link>
                <li><span class="mx-2">/</span></li>
                <inertia-link class="" href="">Create</inertia-link>
            </ol>
        </template>
        <form @submit.prevent="store" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="income_name" value="Income Name" />
                <jet-input id="income_name" type="text" class="mt-1 block w-full" v-model="form.income_name" ref="income_name" autocomplete="off" />
                <div v-if="errors.income_name" class="text-red-500">{{ errors.income_name }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="income_total" value="Income Total" />
                <jet-input id="income_total" type="text" class="mt-1 block w-full" v-model="form.income_total" ref="income_total" autocomplete="off" />
                <div v-if="errors.income_total" class="text-red-500">{{ errors.income_total }}</div>
            </div>

            <div class="mt-2">
                <jet-label for="account" value="Pay with" />
                <select id="account" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.account">
                    <option value="">Please Choose</option>
                    <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                </select>
                <div v-if="errors.account" class="text-red-500">{{ errors.account }}</div>
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
        metaInfo: { title: 'Add New Income' },
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
                    income_name: '',
                    income_total: '',
                    account: '',
                }),
            }
        },
        methods: {
            store() {
                this.form.post(this.route('incomes.store'), {
                    onSuccess: () => this.form.reset(),
                })
            },
        },
    }
</script>
