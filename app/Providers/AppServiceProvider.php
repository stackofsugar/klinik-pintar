<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        /**
         * List of all available gates
         * Group 1: Global User Type
         *    > hasProfile
         *      > patient
         *      > doctor
         *          > active
         *          > inactive
         *      > admin
         *          > god
         *          > global
         *          > poli
         *          > cashier
         */


        /**
         * Admin
         */
        Gate::define("admin.god", function (User $user) {
            return $this->createAdmin("god", $user->id);
        });
        Gate::define("admin.global", function (User $user) {
            return $this->createAdmin("admin", $user->id);
        });
        Gate::define("admin.poli", function (User $user) {
            return $this->createAdmin("admin_poli", $user->id);
        });
        Gate::define("admin.cashier", function (User $user) {
            return $this->createAdmin("cashier", $user->id);
        });
        Gate::define("admin", function (User $user) {
            return $user->canAny(["admin.cashier", "admin.global", "admin.god", "admin.poli"]);
        });

        /**
         * Doctor
         */
        Gate::define("doctor.inactive", function (User $user) {
            return $this->createDoctor($user->id);
        });
        Gate::define("doctor.active", function (User $user) {
            return $this->createDoctor($user->id, true);
        });
        Gate::define("doctor", function (User $user) {
            return $user->canAny(["doctor.active", "doctor.inactive"]);
        });

        /**
         * Patient
         */
        Gate::define("patient", function (User $user) {
            $return = false;
            $result = Patient::join("users", "users.id", "=", "patients.user_id")
                ->where("users.id", "=", $user->id)
                ->first();
            if ($result) {
                $return = true;
            }
            return $return;
        });

        /**
         * hasProfile
         */
        Gate::define("hasProfile", function (User $user) {
            return $user->canAny(["doctor", "admin", "patient"]);
        });

        /**
         * hasNoProfile
         * Hack for Laravel can: middleware
         */
        Gate::define("hasNoProfile", function (User $user) {
            return ($user->cant("doctor") && $user->cant("admin") && $user->cant("patient"));
        });
    }

    private function createAdmin($level, $user_id) {
        $return = false;
        $result = Admin::join("users", "users.id", "=", "admins.user_id")
            ->where("users.id", "=", $user_id)
            ->where("level", "=", $level)
            ->first();
        if ($result) {
            $return = true;
        }
        return $return;
    }

    private function createDoctor($user_id, $isActive = false) {
        $return = false;
        $result = null;

        if (!$isActive) {
            $result = Doctor::join("users", "users.id", "=", "doctors.user_id")
                ->where("users.id", "=", $user_id)
                ->where("is_active", "=", 0)
                ->first();
        } else {
            $result = Doctor::join("users", "users.id", "=", "doctors.user_id")
                ->where("users.id", "=", $user_id)
                ->where("is_active", "=", 1)
                ->first();
        }

        if ($result) {
            $return = true;
        }
        return $return;
    }
}
