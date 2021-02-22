<template>
    <div>
        <h3 class="text-center">All Incomes</h3><br/>
        <div v-if="!isMobile()" class="table-borderless">
            <router-link :to="{name: 'AddIncome'}" class="btn btn-success float-right mb-2"><i class="las la-plus"></i> Add</router-link>

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
                    <tr v-for="(income, index) in incomes" :key="income.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ income.name }}</td>
                        <td>RM{{ income.total }}</td>
                        <td>{{ income.account.name }}</td>
                        <td>{{ income.created_at }}</td>
                        <td>{{ income.updated_at }}</td>
                        <td>
                            <!-- <div class="btn-group" role="group"> -->
                                <!-- <router-link :to="{name: 'editAccount', params: { id: income.id }}"><i class="las la-edit text-info"></i></router-link> -->
                                <a href="#" @click="deleteIncome(income.id)"><i class="las la-trash text-danger"></i></a>
                            <!-- </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="isMobile()">
            <div class="row">
                <div class="col-sm-12">
                    <router-link :to="{name: 'AddIncome'}" class="btn btn-success" style="width: 100%"><i class="las la-plus"></i> Add</router-link>
                </div>
            </div>
            <hr>
            <div class="card" v-for="(income, index) in incomes" :key="income.id">
                <div class="card-info">
                    <h2>{{ income.name }}</h2>
                    <div class="row">
                        <div class="col-sm-6"><strong>Total : </strong>RM{{ income.total }}</div>
                        <div class="col-sm-6"><strong>Paid With : </strong>{{ income.account.name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><strong>Created at : </strong>{{ income.created_at }}</div>
                        <div class="col-sm-6"><strong>Updated at : </strong>{{ income.updated_at }}</div>
                    </div>
                    <hr>
                    <a href="#" class="text-right" @click="deleteIncome(income.id)"><i class="las la-trash text-danger">Delete</i></a>
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
                incomes: [],
            }
        },
        created() {
            axios.get('/api/incomes')
            .then( response=>{
                this.incomes = response.data
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
            deleteIncome(id){
                axios.delete('/api/income/delete/'+id, {
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
