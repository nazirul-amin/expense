<template>
    <div>
        <h3 class="text-center">All Expenses</h3><br/>
        <div v-if="!isMobile()" class="table-borderless">
            <router-link :to="{name: 'AddExpense'}" class="btn btn-success float-right mb-2"><i class="las la-plus"></i> Add</router-link>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Paid With</th>
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
                                <!-- <router-link :to="{name: 'editAccount', params: { id: expense.id }}"><i class="las la-edit text-info"></i></router-link> -->
                                <a href="#" @click="deleteExpense(expense.id)"><i class="las la-trash text-danger"></i></a>
                            <!-- </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="isMobile()">
            <div class="row">
                <div class="col-sm-12">
                    <router-link :to="{name: 'AddExpense'}" class="btn btn-success" style="width: 100%"><i class="las la-plus"></i> Add</router-link>
                </div>
            </div>
            <hr>
            <div class="card" v-for="expense in expenses" :key="expense.id">
                <div class="card-info">
                    <h2>{{ expense.name }}</h2>
                    <div class="row">
                        <div class="col-sm-6"><strong>Total : </strong>RM{{ expense.total }}</div>
                        <div class="col-sm-6"><strong>Paid With : </strong>{{ expense.account.name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><strong>Created at : </strong>{{ expense.created_at }}</div>
                        <div class="col-sm-6"><strong>Updated at : </strong>{{ expense.updated_at }}</div>
                    </div>
                    <hr>
                    <a href="#" class="text-right" @click="deleteExpense(expense.id)"><i class="las la-trash text-danger">Delete</i></a>
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
            isMobile() {
                if( screen.width <= 760 ) {
                    return true;
                }
                else {
                    return false;
                }
            },
            deleteExpense(id){
                axios.delete('/api/expense/delete/'+id, {
                    account: this.account
                })
                .then( response=>{
                    this.$router.push({name: 'Expense'}).catch(err => {});
                })
                .catch( error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
            }
        }
    }
</script>
