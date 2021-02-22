<template>
    <div>
        <h3 class="text-center">Add New Income</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addIncome">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="income.name">
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" class="form-control" v-model="income.total">
                    </div>
                    <div class="form-group">
                        <label>Account</label>
                        <select class="form-control" v-model="income.account_id">
                            <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Income</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                income: {},
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
            addIncome() {
                axios.post('/api/income/add', {
                    income: this.income
                })
                .then( response=>{
                    this.$router.push({name: 'Income'}).catch(err => {});
                })
                .catch( error => {
                    console.log(error);
                })
                .finally(() => this.loading = false)
            }
        }
    }
</script>
