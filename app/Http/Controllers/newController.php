<!--$hospitals = Hospital::all();-->
<!--$hospitals = Hospital::where('city', 'Colombo')->get();-->
<!--$hospitals = Hospital::where('city', 'Colombo')-->
<!--->where('type', 'private')-->
<!--->get();-->
<!--$hospitals = Hospital::where('city', 'Colombo')-->
<!--->orWhere('city', 'Kandy')-->
<!--->get();-->
<!--$hospitals = Hospital::whereIn('id', [1, 2, 3])->get();-->
<!--$hospitals = Hospital::whereBetween('id', [5, 10])->get();-->
<!--$hospitals = Hospital::whereNull('phone_number')->get();-->
<!--$hospitals = Hospital::whereNotNull('email')->get();-->
<!--$hospitals = Hospital::where('name', 'like', '%General%')->get();-->
<!--$hospitals = Hospital::limit(10)->offset(5)->get();-->
<!--$hospitals = Hospital::paginate(10); // for Blade with links()-->
<!--$hospitals = Hospital::paginate(10); // for Blade with links()-->
<!--$names = Hospital::pluck('name'); // Returns collection of names-->
<!--$hospitals = Hospital::select('id', 'name')->get();-->
<!--$hospitals = Hospital::select('city', DB::raw('count(*) as total'))-->
<!--->groupBy('city')-->
<!--->having('total', '>', 5)-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->where('city', 'Colombo')-->
<!--->orWhere('type', 'public')-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->where('city', 'Colombo')-->
<!--->orWhere('type', 'public')-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->whereBetween('id', [1, 10])-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->orderBy('name', 'asc')-->
<!--->limit(10)-->
<!--->offset(5)-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->where('name', 'like', '%General%')-->
<!--->get();-->
<!--$hospitals = DB::table('hospitals')-->
<!--->join('users', 'users.hospital_id', '=', 'hospitals.id')-->
<!--->select('hospitals.*', 'users.name as doctor_name')-->
<!--->get();-->
<!--$hospitals = Hospital::all();-->
<!---->
<!--$filtered = $hospitals->where('type', 'public');-->
<!---->
<!--$names = $hospitals->pluck('name');-->
<!---->
<!--$grouped = $hospitals->groupBy('city');-->
// 1. Get all lab tests
$labtests = Labtest::all();

// 2. Get all lab tests with pets relationship
$labtests = Labtest::with('pets')->get();

// 3. Get lab tests where status is active
$labtests = Labtest::where('status', 'active')->get();

// 4. Get lab tests with pets where status is active
$labtests = Labtest::with('pets')->where('status', 'active')->get();

// 5. Get lab tests with multiple where conditions
$labtests = Labtest::where([
['status', '=', 'active'],
['type', '=', 'blood']
])->get();

// 6. Get lab tests ordered by latest created
$labtests = Labtest::orderBy('created_at', 'desc')->get();

// 7. Get lab tests where type is in list
$labtests = Labtest::whereIn('type', ['blood', 'urine'])->get();

// 8. Get lab tests created between two dates
$labtests = Labtest::whereBetween('created_at', ['2024-01-01', '2024-12-31'])->get();

// 9. Get lab tests with count of related pets
$labtests = Labtest::withCount('pets')->get();

// 10. Paginate lab tests (10 per page)
$labtests = Labtest::with('pets')->paginate(10);

// 11. Get only specific columns
$labtests = Labtest::select('id', 'name', 'type')->get();

// 12. Get lab tests with nested relationships (e.g., pets → owner)
$labtests = Labtest::with('pets.owner')->get();

// 13. Get lab tests using a local scope (e.g., scopeActive in Labtest model)
$labtests = Labtest::active()->get();

// 14. Get first lab test with pets
$labtest = Labtest::with('pets')->first();

// 15. Get lab test by ID with relationship
$labtest = Labtest::with('pets')->find($id);

# 1. Create a model with migration, controller (resource), factory, and seeder
php artisan make:model ModelName -a

# 2. Create a separate migration file (optional if not done in step 1)
php artisan make:migration create_modelname_table

# 3. Create a controller (resource-based, optional if not done in step 1)
php artisan make:controller ModelNameController --resource

# 4. Create a form request class for validation
php artisan make:request StoreModelNameRequest

# 5. Create a factory
php artisan make:factory ModelNameFactory --model=ModelName

# 6. Create a seeder
php artisan make:seeder ModelNameSeeder

# 7. Create a policy
php artisan make:policy ModelNamePolicy --model=ModelName

# 8. Register a resource route (add this in routes/web.php or routes/api.php)
# Route::resource('modelnames', ModelNameController::class)

# 9. Run migrations
php artisan migrate

# 10. Run seeders
php artisan db:seed --class=ModelNameSeeder

php artisan make:mail AppointmentCreatedMail
