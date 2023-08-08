<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RoleManagement\LoginAuthController;
use App\Http\Controllers\RoleManagement\AdminController;
use App\Http\Controllers\RoleManagement\SuperAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NewApiController;






use App\Mail\SendEmailMailable;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes(); // if we want a auth login we need to remove the comment

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('agecheck');// just for understanding the middleware i wrote here

//Crud operations.....
Route::resource('crud', StudentController::class);




//Sending Email using the laravel

Route::get('SendEmail',function(){

    $job=(new SendEmailJob())

                    ->delay(Carbon::now()->addSeconds(5));
                    
    dispatch( $job);
    return "email sent succesfully";
});


// ----------------------------------
Route::get('email-new', function(){
  
    $details['email'] = 'your_email@gmail.com';
  
    dispatch(new App\Jobs\SendEmailJob($details));
  
    dd('done');
});

// --------------------------------------------------------------
//Api 

Route::get('/api', [ApiController::class, 'index']);


// Role management routes.........

//login
Route::get('/custom-login', [LoginAuthController::class, 'login'])->name('custom-login');
Route::post('/login-user', [LoginAuthController::class, 'loginUser'])->name('login-user');

//Register 
Route::get('/custom-registration', [LoginAuthController::class, 'registration']);
Route::post('/register-user', [LoginAuthController::class, 'RegisterUser'])->name('register-user');

// Admin
Route::middleware(['role:admin'])->group(function () {
    

            //Fetch route...
            Route::get('/admin', [AdminController::class, 'fetchData']);
            Route::get('/fetch', [AdminController::class, 'newData']);

            // Edit route
            Route::get('/edit_user/{id}', [AdminController::class, 'editUser']);
            // Update route
            Route::post('/update_user/{id}', [AdminController::class, 'updateUser']);
            //Delete route...
            Route::delete('/delete-user/{id}', [AdminController::class, 'destroy']);



            // Add user
            Route::post('/add_user', [AdminController::class, 'store']);
                // Add other routes accessible to the superadmin role here
            });




// superadmin
Route::get('/superadmin', [SuperAdminController::class, 'fetchData']);


// logout
Route::get('/logout', [LoginAuthController::class, 'logout']);

// delete
Route::delete('/users/{id}', [AdminController::class, 'delete'])->name('users.delete');



// practice route...
Route::get('/new', [LoginAuthController::class, 'new']);


// Customer task 


// Route for the customer form 
Route::get('/index', [CustomerController::class, 'index']);

// Saving the form_data

Route::post('/store_data', [CustomerController::class, 'store']);

// Listing the customers data using this route

Route::get('/display', [CustomerController::class, 'display']);

// filtering the data using the date_of_birth
Route::post('/display/filter',[CustomerController::class, 'filter'])->name('customer.filter');

// Update the customers data routes
Route::get('customers/{customer}/edit', [CustomerController::class, 'show']);

Route::put('/customers/{customerId}/update', [CustomerController::class, 'update'])->name('customer.update');




// External api calling

Route::get('/apinew', [NewApiController::class, 'makeApiRequest']);
Route::post('/api-curl', [ApiController::class, 'callApiWithCurl']);

// 

// routes/web.php

// use App\Http\Controllers\;

Route::get('/guzzleapi', [NewApiController::class, 'guzzleapi']);
Route::get('/curlapi', [NewApiController::class, 'CurlApi']);











