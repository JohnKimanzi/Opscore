<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientsSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(BenefitSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(EducationLevelSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(EmployeeStatusSeeder::class);
        $this->call(DisabilityStatusSeeder::class);
        $this->call(HealthStatusSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(DeliveryTypeSeeder::class);
        $this->call(ServiceTypeSeeder::class);
        $this->call(ProjectTypeSeeder::class);
        $this->call(BillingTypeSeeder::class);
        $this->call(BillingFrequencySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
    }
}
