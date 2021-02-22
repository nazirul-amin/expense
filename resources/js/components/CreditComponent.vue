<template>
    <div>
        <h3 class="text-center">Credit Debts</h3><br/>
        <div v-if="!isMobile()" class="table-borderless">
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
                    <tr v-for="(expense, index) in expenses" :key="expense.id" v-if="expense.account.type_id==3">
                        <td>{{ index + 1 }}</td>
                        <td>{{ expense.name }}</td>
                        <td>RM{{ expense.total }}</td>
                        <td>{{ expense.account.name }}</td>
                        <td>{{ expense.created_at }}</td>
                        <td>{{ expense.updated_at }}</td>
                        <td>
                            <!-- <div class="btn-group" role="group"> -->
                                <router-link :to="{name: 'EditAccount', params: { id: expense.id }}"><i class="las la-money-bill text-info">Pay</i></router-link>
                            <!-- </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="isMobile()">
            <div class="card" v-for="(expense, index) in expenses" :key="expense.id" v-if="expense.account.type_id==3">
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
                    <router-link :to="{name: 'EditAccount', params: { id: expense.id }}" class="text-right"><i class="las la-money-bill text-info">Pay</i></router-link>
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
                todayDate: new Date(),
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
        },
    }
</script>
