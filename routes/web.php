<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

use Spatie\Activitylog\Models\Activity;

if (App::environment('production')) {
    URL::forceScheme('https');
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $admin = Auth::user()->is_admin;
    if ($admin == false) {
        $chartData = Transaction::with('account')->orderBy('name')->where('user_id', Auth::id())->paginate(10);

        $x = 0;
        foreach ($chartData as $data) {
            $datasets[$x]['label'] = $data->name;
            if($data->transaction_type == 'Expense'){
                $datasets[$x]['backgroundColor'] = '#ec4646';
            }
            if($data->transaction_type == 'Income'){
                $datasets[$x]['backgroundColor'] = '#9ddfd3';
            }
            $datasets[$x]['data'] = [['x' => Carbon::parse($data->created_at)->format('d/m/Y'), 'y'=> $data->total]];
            $x++;
        }
        // dump($datasets);
        $data['charts'] =[
            // 'labels'  => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'Expense',
                    'backgroundColor' => '#ec4646',
                    'borderColor' => '#ec4646',
                    'fill' => 'false',
                    'data' => [
                            ['x' => Carbon::parse('03/01/2021')->format('d/m/Y'), 'y'=> 2000],
                            ['x' => Carbon::parse('03/02/2021')->format('d/m/Y'), 'y'=> 3500],
                            ['x' => Carbon::parse('03/03/2021')->format('d/m/Y'), 'y'=> 1000],
                            ['x' => Carbon::parse('03/04/2021')->format('d/m/Y'), 'y'=> 2000],
                            ['x' => Carbon::parse('03/05/2021')->format('d/m/Y'), 'y'=> 1000],
                            ['x' => Carbon::parse('03/06/2021')->format('d/m/Y'), 'y'=> 3500],
                            ['x' => Carbon::parse('03/07/2021')->format('d/m/Y'), 'y'=> 2000],
                            ['x' => Carbon::parse('03/08/2021')->format('d/m/Y'), 'y'=> 1000],
                            ['x' => Carbon::parse('03/09/2021')->format('d/m/Y'), 'y'=> 2000],
                            ['x' => Carbon::parse('03/10/2021')->format('d/m/Y'), 'y'=> 1000],
                            ['x' => Carbon::parse('03/11/2021')->format('d/m/Y'), 'y'=> 3500],
                            ['x' => Carbon::parse('03/12/2021')->format('d/m/Y'), 'y'=> 3500],
                        ]
                ],
                [
                    'label' => 'Income',
                    'backgroundColor' => '#9ddfd3',
                    'borderColor' => '#9ddfd3',
                    'fill' => 'false',
                    'data' => [
                            ['x' => Carbon::parse('05/01/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/02/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/03/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/04/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/05/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/06/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/07/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/08/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/09/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/10/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/11/2021')->format('d/m/Y'), 'y'=> 5000],
                            ['x' => Carbon::parse('05/12/2021')->format('d/m/Y'), 'y'=> 5000],
                        ]
                ],
            ]
            // 'datasets' => $datasets
        ];
        return Inertia::render('Dashboard', $data);
    }
    if ($admin == true) {
        $data['activities'] = Activity::all();
        return Inertia::render('Admin/Dashboard', $data);
    }
})->name('dashboard');

//----- account route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', [AccountController::class, 'index'])->name('accounts');
    Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/{account}', [AccountController::class, 'show'])->name('account.show');
    Route::middleware(['auth:sanctum', 'verified'])->get('/account/create', [AccountController::class, 'create'])->name('account.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/accounts', [AccountController::class, 'store'])->name('account.store');
    Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/accounts/{account}', [AccountController::class, 'update'])->name('account.update');
    Route::middleware(['auth:sanctum', 'verified'])->delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('account.destroy');
//----- account route -----//

//----- expense route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
    Route::middleware(['auth:sanctum', 'verified'])->get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::middleware(['auth:sanctum', 'verified'])->get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::middleware(['auth:sanctum', 'verified'])->delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
//----- expense route -----//

//----- income route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/incomes', [IncomeController::class, 'index'])->name('incomes');
    Route::middleware(['auth:sanctum', 'verified'])->get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/incomes', [IncomeController::class, 'store'])->name('incomes.store');
    Route::middleware(['auth:sanctum', 'verified'])->get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/incomes/{income}', [IncomeController::class, 'update'])->name('incomes.update');
    Route::middleware(['auth:sanctum', 'verified'])->delete('/incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
//----- income route -----//

//----- credit route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/credits', [CreditController::class, 'index'])->name('credits');
    Route::middleware(['auth:sanctum', 'verified'])->get('/credits/create', [CreditController::class, 'create'])->name('credits.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/credits', [CreditController::class, 'store'])->name('credits.store');
    Route::middleware(['auth:sanctum', 'verified'])->get('/credits/{credit}/edit', [CreditController::class, 'edit'])->name('credits.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/credits/{credit}', [CreditController::class, 'update'])->name('credits.update');
    Route::middleware(['auth:sanctum', 'verified'])->delete('/credits/{expense}', [CreditController::class, 'destroy'])->name('credits.destroy');
//----- credit route -----//

//----- user route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/users', [UserController::class, 'index'])->name('users');
    Route::middleware(['auth:sanctum', 'verified'])->get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/users', [UserController::class, 'store'])->name('users.store');
    Route::middleware(['auth:sanctum', 'verified'])->get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::middleware(['auth:sanctum', 'verified'])->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//----- user route -----//

//----- transaction route -----//
    Route::middleware(['auth:sanctum', 'verified'])->get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::middleware(['auth:sanctum', 'verified'])->get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::middleware(['auth:sanctum', 'verified'])->post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
//----- transaction route -----//
