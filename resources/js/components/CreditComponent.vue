<template>
    <div>
        <h3 class="text-center">Credit Debts</h3><br/>
        <div class="table-borderless">
            <router-link :to="{name: 'AddExpense'}" class="btn btn-success float-right mb-2"><i class="las la-plus"></i> Add</router-link>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Paid By</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(expense, index) in expenses" :key="expense.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ expense.name }}</td>
                        <td>RM{{ expense.total }}</td>
                        <td>{{ expense.account.name }}</td>
                        <td>{{ expense.created_at }}</td>
                        <td>{{ expense.updated_at }}</td>
                        <td>
                            <!-- <div class="btn-group" role="group"> -->
                                <router-link :to="{name: 'editAccount', params: { id: expense.id }}"><i class="las la-edit text-info"></i></router-link>
                                <a href="#" @click="deleteAccount(expense.id)"><i class="las la-trash text-danger"></i></a>
                            <!-- </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    moment().format('dd/mm/yyyy');

    export default {
        data() {
            return {
                expenses: [],
            }
        },
        created() {
            axios.get('/api/expenses')
            .then( response=>{
                this.expenses = response.data
            })
            .catch( error => {
                console.log(error);
            })
        },
        methods: {
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
