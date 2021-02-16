<template>
    <div>
        <h3 class="text-center">Add New Expense</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addExpense">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="expense.name">
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" class="form-control" v-model="expense.total">
                    </div>
                    <div class="form-group">
                        <label>Pay With</label>
                        <select v-for="account in accounts" class="form-control" v-model="expense.account_id">
                            <option :value="account.id">{{ account.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                expense: {},
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
            addExpense() {
                axios.post('/api/expense/add', {
                    expense: this.expense
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
