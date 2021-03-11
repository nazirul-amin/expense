<template>
    <app-layout>
        <form @submit.prevent="store" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
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
        metaInfo: { title: 'Create New Account' },
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetActionMessage,
        },
        props: {
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    account_name: '',
                    account_balance: '',
                }),
            }
        },
        methods: {
            store() {
                this.form.post(this.route('accounts.store'), {
                    onSuccess: () => this.form.reset(),
                })
            },
        },
    }
</script>
