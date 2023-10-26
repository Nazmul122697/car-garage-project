<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `faqs` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Do I have to register to get a Health Certificate from BFSA?', 'Yes, To get a Health Certificate From BFSA, You have to be registered to our online e-Health Certification System as our Customer User. ', 1, '2023-03-19 03:48:41', '2023-03-19 03:48:41'),
        (2, 'Do I have to provide proof authentic business documents?', 'Yes, you must provide proof of authentic business documents after registration. Your registration information provided will be validated from those documents. ', 1, '2023-03-19 03:49:03', '2023-03-19 03:49:03'),
        (3, 'How much will I be charged for acquiring a Health Certificate? ', 'You will be charged as per FOB value of provided invoice along with 15% vat of certificate and additional 10% Income tax in BFSA’s Name. ', 1, '2023-03-19 03:49:48', '2023-03-19 03:49:48'),
        (4, 'Can I make the payment online?', 'Yes, Payment of Health Certificate can be made online.', 1, '2023-03-19 03:50:13', '2023-03-19 03:50:13'),
        (5, 'Can my certificate be verified without login? ', 'Yes, The Health Certificate provided by our online e-Health Certification System comes with a QR code. By Scanning the QR code, a link will be provided which will show the Health Certificate. ', 1, '2023-03-19 03:50:38', '2023-03-19 03:50:38')");
    }
}
