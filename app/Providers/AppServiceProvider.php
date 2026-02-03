<?php

namespace App\Providers;

use App\Contracts\AttendanceRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\Emplementations\EloquentAttendanceRepository;
use App\Contracts\Emplementations\EloquentCourseRepository;
use App\Contracts\Emplementations\EloquentEnrollmentRepository;
use App\Contracts\Emplementations\EloquentGradeRepository;
use App\Contracts\Emplementations\EloquentSessionRepository;
use App\Contracts\Emplementations\EloquentStudentRepository;
use App\Contracts\EnrollmentRepositoryInterface;
use App\Contracts\GradeRepositoryInterface;
use App\Contracts\SessionRepositoryInterface;
use App\Contracts\StudentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SessionRepositoryInterface::class, EloquentSessionRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, EloquentStudentRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, EloquentCourseRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, EloquentGradeRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EloquentEnrollmentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, EloquentAttendanceRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
