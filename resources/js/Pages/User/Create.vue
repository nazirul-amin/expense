<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('users')">Users</inertia-link>
                <li><span class="mx-2">/</span></li>
                <inertia-link class="" href="">Create</inertia-link>
            </ol>
        </template>
        <form @submit.prevent="store" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="account_name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
            </div>
            <div class="mt-2">
                <jet-label for="account_balance" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                <div v-if="errors.email" class="text-red-500">{{ errors.email }}</div>
            </div>
            <div class="mt-2">
                <jet-label for="account_balance" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <div v-if="errors.password" class="text-red-500">{{ errors.password }}</div>
            </div>
            <div class="mt-2">
                <jet-label for="account_balance" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <div v-if="errors.password_confirmation" class="text-red-500">{{ errors.password_confirmation }}</div>
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
    import AppLayout from '@/Layouts/AppLayout_admin'
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
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }),
            }
        },
        methods: {
            store() {
                this.form.post(this.route('users.store'), {
                    onSuccess: () => this.form.reset(),
                })
            },
        },
    }
</script>
