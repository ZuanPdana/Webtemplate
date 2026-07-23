<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->pluck('id')->all();

        if ($users === []) {
            $users = User::factory()->count(10)->create()->pluck('id')->all();
        }

        $templates = [
            [
                'type' => 'order.created',
                'title' => 'Order received',
                'message' => 'Your order has been received and is waiting for confirmation.',
            ],
            [
                'type' => 'order.shipped',
                'title' => 'Order shipped',
                'message' => 'Your order is on the way and will arrive soon.',
            ],
            [
                'type' => 'promotion',
                'title' => 'New coupon available',
                'message' => 'A new discount coupon is available for your next checkout.',
            ],
            [
                'type' => 'review.reminder',
                'title' => 'Share your feedback',
                'message' => 'Tell us what you think about your recent meal and help other customers.',
            ],
        ];

        $now = Carbon::now();
        $rows = [];

        foreach (range(1, 20) as $index) {
            $template = $templates[array_rand($templates)];
            $createdAt = $now->copy()->subDays(random_int(0, 14))->subHours(random_int(0, 23));
            $readAt = fake()->boolean(60) ? $createdAt->copy()->addHours(random_int(1, 6)) : null;

            $rows[] = [
                'user_id' => $users[array_rand($users)],
                'type' => $template['type'],
                'title' => $template['title'],
                'message' => $template['message'],
                'action_url' => fake()->optional()->url(),
                'data' => json_encode([
                    'reference' => fake()->bothify('REF-####'),
                    'priority' => fake()->randomElement(['low', 'normal', 'high']),
                ]),
                'is_read' => $readAt !== null,
                'read_at' => $readAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'deleted_at' => null,
            ];
        }

        Notification::query()->insert($rows);
    }
}
