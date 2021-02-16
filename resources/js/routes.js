import Home from './components/HomeComponent.vue';

import Account from './components/AccountComponent.vue';
import AddAccount from './components/AddAccountComponent.vue';

import Expense from './components/ExpenseComponent.vue';
import AddExpense from './components/AddExpenseComponent.vue';

import Credit from './components/CreditComponent.vue';

export default {
    mode: 'history',

    routes: [

        {
            name: 'Home',
            path: '/',
            component: Home
        },
        {
            name: 'Account',
            path: '/account',
            component: Account
        },
        {
            name: 'addAccount',
            path: '/account/add',
            component: AddAccount
        },
        {
            name: 'editAccount',
            path: '/account/edit/:id',
            component: AddAccount
        },
        {
            name: 'Expense',
            path: '/expense',
            component: Expense
        },
        {
            name: 'AddExpense',
            path: '/expense/add',
            component: AddExpense
        },
        {
            name: 'Credit',
            path: '/credit',
            component: Credit
        },
    ]
}
