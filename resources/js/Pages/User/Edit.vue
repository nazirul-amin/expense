<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" :href="route('accounts')">Accounts</inertia-link>
                <li><span class="mx-2">/</span></li>
                <inertia-link class="" href="">Edit</inertia-link>
            </ol>
        </template>
        <form @submit.prevent="update" class="flex flex-col justify-center w-full md:w-6/12 mx-auto">
            <div class="mt-2">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
            </div>
            <div class="mt-2">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                <div v-if="errors.email" class="text-red-500">{{ errors.email }}</div>
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
    import AppLayout from '@/Layouts/AppLayout_admin'
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
            user: Object,
            errors: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                }),
            }
        },
        methods: {
            update() {
                this.form.put(this.route('users.update', this.user.id))
            },
            destroy() {
                if (confirm('Are you sure you want to delete this user?')) {
                    this.$inertia.delete(this.route('users.destroy', this.user.id))
                }
            },
        },
    }
</script>
