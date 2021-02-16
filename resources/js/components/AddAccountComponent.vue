<template>
    <div>
        <h3 class="text-center">Add New Account</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="addAccount">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="account.name">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" v-model="account.type_id">
                            <option value="1">Cash</option>
                            <option value="2">Bank</option>
                            <option value="3">Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Balance</label>
                        <input type="text" class="form-control" v-model="account.balance">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Account</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                account: {},
            }
        },
        methods: {
            addAccount() {
                axios.post('/api/account/add', {
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
