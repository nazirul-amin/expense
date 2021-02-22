<template>
    <div>
        <h3 class="text-center">All Accounts</h3><br/>
        <div v-if="!isMobile()" class="table-borderless">
            <router-link :to="{name: 'addAccount'}" class="btn btn-success float-right mb-2"><i class="las la-plus"></i> Add</router-link>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(account, index) in accounts" :key="account.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ account.name }}</td>
                        <td>RM{{ account.balance }}</td>
                        <td>{{ account.created_at }}</td>
                        <td>{{ account.updated_at }}</td>
                        <td>
                            <!-- <div class="btn-group" role="group"> -->
                                <!-- <router-link :to="{name: 'EditAccount', params: { id: account.id }}"><i class="las la-edit text-info"></i></router-link> -->
                                <a href="" @click="deleteAccount(account.id)"><i class="las la-trash text-danger"></i></a>
                            <!-- </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="isMobile()">
            <div class="row">
                <div class="col-sm-12">
                    <router-link :to="{name: 'addAccount'}" class="btn btn-success" style="width: 100%"><i class="las la-plus"></i> Add</router-link>
                </div>
            </div>
            <hr>
            <div class="card" v-for="account in accounts" :key="account.id">
                <div class="card-info">
                    <h2>{{ account.name }}</h2>
                    <div class="row">
                        <div class="col-sm-6"><strong>Total : </strong>RM{{ account.balance }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><strong>Created at : </strong>{{ account.created_at }}</div>
                        <div class="col-sm-6"><strong>Updated at : </strong>{{ account.updated_at }}</div>
                    </div>
                    <hr>
                    <a href="#" class="text-right" @click="deleteAccount(account.id)"><i class="las la-trash text-danger">Delete</i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    moment().format('dd/mm/yyyy');

    export default {
        data() {
            return {
                accounts: [],
            }
        },
        created() {
            axios.get('/api/accounts')
            .then( response=>{
                this.accounts = response.data
            })
            .catch( error => {
                console.log(error);
            })
        },
        methods: {
            isMobile() {
                if( screen.width <= 760 ) {
                    return true;
                }
                else {
                    return false;
                }
            },
            deleteAccount(id){
                axios.delete('/api/account/delete/'+id, {
                    account: this.account
                })
                .then( response=>{
                    this.$router.push({name: 'Account'}).catch(err => {});
                })
                .catch( error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
            }
        }
    }
</script>
