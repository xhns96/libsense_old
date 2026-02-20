<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Support\Facades\Http;

class UpdateStudentDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $currentUser;

    /**
     * Create a new job instance.
     *
     * @param \App\User $currentUser
     */

   
    public function __construct(User $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://student.andmiedu.uz/rest/v1/data/student-list?_student_status=-1&search=' . $this->currentUser->student_id_number;

        try {
            // Отправляем запрос на API
            $response = Http::withToken('UHi4-DZ7gIZb3tCfitdWrt4rzqQmNrlU')->get($url)->json();

            if (isset($response['data']['items']) && count($response['data']['items']) > 0) {
                foreach ($response['data']['items'] as $item) {
                    $user = User::where('student_id_number', $this->currentUser->student_id_number)->first();

                    if ($user) {
                        $updated = false;

                        if ($user->name !== $item['full_name']) {
                            $user->name = $item['full_name'];
                            $updated = true;
                        }

                        if ($user->user_faculty_name !== $item['department']['name']) {
                            $user->user_faculty_name = $item['department']['name'];
                            $updated = true;
                        }

                        if ($user->user_specialty_name !== $item['specialty']['name']) {
                            $user->user_specialty_name = $item['specialty']['name'];
                            $updated = true;
                        }

                        if ($user->user_course_name !== $item['level']['name']) {
                            $user->user_course_name = $item['level']['name'];
                            $updated = true;
                        }

                        if ($user->user_group_name !== $item['group']['name']) {
                            $user->user_group_name = $item['group']['name'];
                            $updated = true;
                        }

                        if ($user->user_profile_image !== $item['image']) {
                            $user->user_profile_image = $item['image'];
                            $updated = true;
                        }

                        $newStatus = $item['studentStatus']['code'] == 11 ? 'active' : 'inactive';
                        if ($user->user_profile_status !== $newStatus) {
                            $user->user_profile_status = $newStatus;
                            $updated = true;
                        }

                        if ($updated) {
                            $user->save();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Логирование ошибки
            \Log::error('API Request failed for student: ' . $this->currentUser->student_id_number);
        }
    }
}
