<?php

namespace Database\Seeders;

use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  [
            [
                'question' => 'How do I buy a ticket on Fastbus?',
                'answer' => 'You can book the tickets online which is a very simple three step process. We advise you to book your tickets at least two hours before scheduled departure. After you purchase your ticket you will receive an email confirmation that also serves as your boarding pass for most of the bus partners. We don\'t oversell our schedules, so this boarding pass will guarantee you a seat on your ticketed schedule.',
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'question' => 'What happens when my schedule/service is cancelled?',
                'answer' => 'We\'ll make every effort to ensure that your travel is not affected by providing alternate services to help you reach the destination.',
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'question' => 'Do I have to pay extra when compared to buying the tickets offline?',
                'answer' => 'Fastbus does not charge anything extra when compared to the traditional way (offline). The tickets are absolutely at the same cost that the travel bus partner has priced them.',
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'question' => 'I’ve lost my ticket printout. What do I do now?',
                'answer' => 'A copy of the ticket would have been sent to you by e-mail when you booked the ticket. Please take a printout of that mail and produce it at the time of boarding. If you have not received your ticket to the e-mail id you provided, you can take a printout on AbhiBus.com website by entering the PNR Number that was sent you by SMS while booking the ticket.',
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'question' => 'Is it mandatory to carry the required identity proofs along with the e-ticket?',
                'answer' => 'Yes. It is mandatory to carry government issued identity proofs along with your e-ticket.',
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],
        ];
        Faq::insert($data);
    }
}
