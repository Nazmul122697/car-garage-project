<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `tutorials` (`id`, `title`, `url`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'নিরাপদ খাদ্য বিষয়ক পারিবারিক নির্দেশিকা সংক্রান্ত টিভিসি1', 'https://www.youtube.com/embed/APw8d-4JLaE', 1, '2023-03-19 03:48:41', '2023-03-19 03:48:41'),
        (2, 'খাদ্য স্পর্শক বিষয়ক টিভিসি2', 'https://www.youtube.com/embed/vXHoBrEC9vA', 1, '2023-03-19 03:49:03', '2023-03-19 03:49:03'),
        (3, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (ময়মনসিংহ)3', 'https://www.youtube.com/embed/TNLTvnoN1hk', 1, '2023-03-19 03:49:48', '2023-03-19 03:49:48'),
        (4, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (সিলেট)4', 'https://www.youtube.com/embed/cyAnW72IR4k', 1, '2023-03-19 03:50:13', '2023-03-19 03:50:13'),
        (5, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (রংপুর)5', 'https://www.youtube.com/embed/Sokenh-4-7g', 1, '2023-03-19 03:50:38', '2023-03-19 03:50:38'),
        (6, 'নিরাপদ খাদ্য বিষয়ক পারিবারিক নির্দেশিকা সংক্রান্ত টিভিসি6', 'https://www.youtube.com/embed/APw8d-4JLaE', 1, '2023-03-19 03:48:41', '2023-03-19 03:48:41'),
        (7, 'খাদ্য স্পর্শক বিষয়ক টিভিসি7', 'https://www.youtube.com/embed/vXHoBrEC9vA', 1, '2023-03-19 03:49:03', '2023-03-19 03:49:03'),
        (8, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (ময়মনসিংহ)8', 'https://www.youtube.com/embed/TNLTvnoN1hk', 1, '2023-03-19 03:49:48', '2023-03-19 03:49:48'),
        (9, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (সিলেট)9', 'https://www.youtube.com/embed/cyAnW72IR4k', 1, '2023-03-19 03:50:13', '2023-03-19 03:50:13'),
        (10, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (রংপুর)10', 'https://www.youtube.com/embed/Sokenh-4-7g', 1, '2023-03-19 03:50:38', '2023-03-19 03:50:38'),
        (11, 'নিরাপদ খাদ্য বিষয়ক পারিবারিক নির্দেশিকা সংক্রান্ত টিভিসি11', 'https://www.youtube.com/embed/APw8d-4JLaE', 1, '2023-03-19 03:48:41', '2023-03-19 03:48:41'),
        (12, 'খাদ্য স্পর্শক বিষয়ক টিভিসি12', 'https://www.youtube.com/embed/vXHoBrEC9vA', 1, '2023-03-19 03:49:03', '2023-03-19 03:49:03'),
        (13, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (ময়মনসিংহ)13', 'https://www.youtube.com/embed/TNLTvnoN1hk', 1, '2023-03-19 03:49:48', '2023-03-19 03:49:48'),
        (14, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (সিলেট)14', 'https://www.youtube.com/embed/cyAnW72IR4k', 1, '2023-03-19 03:50:13', '2023-03-19 03:50:13'),
        (15, 'নিরাপদ খাদ্য বিষয়ক আঞ্চলিক গান (রংপুর)15', 'https://www.youtube.com/embed/Sokenh-4-7g', 1, '2023-03-19 03:50:38', '2023-03-19 03:50:38'),
        (16, 'মোড়কজাত খাদ্যপণ্যে লেবেলিং বিষয়ক বিধিবিধান।16', 'https://www.youtube.com/embed/98BVIuz8hBI', 1, '2023-03-19 03:51:10', '2023-03-19 03:51:10')");
    }
}
