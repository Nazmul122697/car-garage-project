<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'image' => 'about.jpg',

            'history' => "The Bangladesh National Parliament passed the Food Safety Act, 2013 in order to make provisions for the establishment of an efficient, effective, scientifically based Authority and for regulating, through coordination, the activities relating to food production, import, processing, stockpiling, supplying, marketing and sales as well as to ensure the people’s right toward access to safe food through appropriate application of scientific processes and state of the art technology. The Bangladesh Food Safety Authority was established in 2015 with a commitment to make a united start with its full strength and unstinting efforts. The Authority whole-heartedly welcomes the all-out support of all food control agencies, food business operators and people of the country towards the landmark goal of establishing a Modern and Technological Food Safety System in Bangladesh to contribute to the government’s Vision 2021.",

            'history_bn' => "বাংলাদেশ জাতীয় সংসদ খাদ্য নিরাপত্তা আইন, 2013 পাশ করেছে যাতে একটি দক্ষ, কার্যকর, বৈজ্ঞানিকভাবে ভিত্তিক কর্তৃপক্ষ প্রতিষ্ঠা এবং খাদ্য উৎপাদন, আমদানি, প্রক্রিয়াকরণ, মজুদ, সরবরাহ সম্পর্কিত কার্যক্রমগুলিকে সমন্বয়ের মাধ্যমে নিয়ন্ত্রণ করার জন্য বিধান করা হয়। বিপণন এবং বিক্রয়ের পাশাপাশি বৈজ্ঞানিক প্রক্রিয়া এবং অত্যাধুনিক প্রযুক্তির যথাযথ প্রয়োগের মাধ্যমে নিরাপদ খাদ্যের অ্যাক্সেসের প্রতি জনগণের অধিকার নিশ্চিত করা। বাংলাদেশ ফুড সেফটি অথরিটি 2015 সালে তার পূর্ণ শক্তি এবং নিরলস প্রচেষ্টার সাথে ঐক্যবদ্ধভাবে শুরু করার অঙ্গীকার নিয়ে প্রতিষ্ঠিত হয়েছিল। সরকারের রূপকল্প 2021-এ অবদান রাখার জন্য বাংলাদেশে একটি আধুনিক ও প্রযুক্তিগত খাদ্য নিরাপত্তা ব্যবস্থা প্রতিষ্ঠার যুগান্তকারী লক্ষ্যের দিকে সমস্ত খাদ্য নিয়ন্ত্রণ সংস্থা, খাদ্য ব্যবসা অপারেটর এবং দেশের জনগণের সর্বাত্মক সমর্থনকে কর্তৃপক্ষ আন্তরিকভাবে স্বাগত জানায়। ",

            'mission' => "BFSA was established under Section 5 of The Food Safety Act, 2013 of the People's Republic of Bangladesh with the mandate of making 'provisions for the establishment of an efficient and effective authority and for regulating, through coordination, the activities relating to food production, import, stock supply, marketing and sales, so as to ensure the rights toward access to safe food through appropriate application of scientific process, upon repealing and enacting the existing laws connected thereto.' Section 13(1) also states that the main duties and functions of BFSA shall be 'to regulate and monitor the activities related to manufacture, import, processing, storage, distribution and sale of food so as to ensure access of safe food through exercise of appropriate of scientific methods, and to coordinate the activities of all organizations concerned with food safety management.' It is also clear from Section 13(4) that BFSA shall make Regulations to carry out the purposes of Section 13 of the Act. Thus, it is clear that BFSA shall make all kinds of regulations that meet the objectives of the Act and support organizations in updating and upgrading the existing standards.",

            "mission_bn" => "বাংলাদেশ নিরাপত্তা খাদ্য কর্তৃপক্ষ  গণপ্রজাতন্ত্রী বাংলাদেশ এর খাদ্য নিরাপত্তা আইন, 2013 এর ধারা 5 এর অধীনে 'একটি দক্ষ ও কার্যকর কর্তৃপক্ষ প্রতিষ্ঠার জন্য এবং খাদ্য উৎপাদন, আমদানি সম্পর্কিত কার্যক্রমগুলিকে সমন্বয়ের মাধ্যমে নিয়ন্ত্রণ করার জন্য বিধান প্রণয়নের আদেশ দিয়ে প্রতিষ্ঠিত হয়েছিল। , স্টক সরবরাহ, বিপণন এবং বিক্রয়, যাতে এর সাথে যুক্ত বিদ্যমান আইনগুলি বাতিল ও প্রণয়নের মাধ্যমে বৈজ্ঞানিক প্রক্রিয়ার যথাযথ প্রয়োগের মাধ্যমে নিরাপদ খাদ্যের অ্যাক্সেসের অধিকার নিশ্চিত করা যায়।' ধারা 13(1) এও বলে যে BFSA-এর প্রধান দায়িত্ব ও কাজগুলি হল ''খাদ্য উত্পাদন, আমদানি, প্রক্রিয়াকরণ, সঞ্চয়, বিতরণ এবং বিক্রয় সম্পর্কিত ক্রিয়াকলাপগুলি নিয়ন্ত্রণ এবং পর্যবেক্ষণ করা যাতে অনুশীলনের মাধ্যমে নিরাপদ খাদ্যের অ্যাক্সেস নিশ্চিত করা যায়৷ বৈজ্ঞানিক পদ্ধতির উপযুক্ত, এবং খাদ্য নিরাপত্তা ব্যবস্থাপনার সাথে সংশ্লিষ্ট সকল সংস্থার কার্যক্রম সমন্বয় করা।' 'ধারা 13(4) থেকে এটিও স্পষ্ট যে BFSA আইনের 13 ধারার উদ্দেশ্যগুলি সম্পাদন করার জন্য প্রবিধান তৈরি করবে৷ এইভাবে, এটা স্পষ্ট যে BFSA সমস্ত ধরণের প্রবিধান তৈরি করবে যা আইনের উদ্দেশ্য পূরণ করে এবং বিদ্যমান মানগুলি আপডেট এবং আপগ্রেড করার ক্ষেত্রে সংস্থাগুলিকে সহায়তা করে৷",

            'vision' => "The vision of the Bangladesh Food Safety Authority (BFSA) is to ensure access to safe and nutritious food for all citizens of Bangladesh. This vision is mentioned on the BFSA website under the 'About BFSA' section. Here's the direct quote: 'The vision of BFSA is to ensure access to safe and nutritious food for all citizens of Bangladesh through the application of science-based risk assessment, risk management, and risk communication approaches.",

            'vision_bn' => "বাংলাদেশ নিরাপত্তা খাদ্য কর্তৃপক্ষ এর দৃষ্টিভঙ্গি হল বাংলাদেশের সকল নাগরিকের জন্য নিরাপদ ও পুষ্টিকর খাবারের অ্যাক্সেস নিশ্চিত করা। এই দৃষ্টিভঙ্গিটি বিএফএসএ ওয়েবসাইটে 'বিএফএসএ সম্পর্কে' বিভাগের অধীনে উল্লেখ করা হয়েছে। এখানে সরাসরি উদ্ধৃতি: 'BFSA এর দৃষ্টিভঙ্গি হল বিজ্ঞান-ভিত্তিক ঝুঁকি মূল্যায়ন, ঝুঁকি ব্যবস্থাপনা এবং ঝুঁকি যোগাযোগ পদ্ধতির প্রয়োগের মাধ্যমে বাংলাদেশের সকল নাগরিকের জন্য নিরাপদ এবং পুষ্টিকর খাবারের অ্যাক্সেস নিশ্চিত করা।",

            'strategy' => "The Bangladesh Food Safety Authority (BFSA) has developed a strategic plan to ensure food safety in the country. The strategic plan outlines the BFSA's vision, mission, values, and objectives. The plan is available on the BFSA website under the 'Strategic Plan' section. Here are some key strategies mentioned in the plan: Development and implementation of food safety standards and guidelines Strengthening the regulatory framework for food safety Enhancing food safety surveillance and monitoring systems Promoting public awareness and education on food safety Strengthening the capacity of BFSA and stakeholders in food safety management Strengthening international collaboration and cooperation on food safety",

            'strategy_bn' => "বাংলাদেশ নিরাপত্তা খাদ্য কর্তৃপক্ষ দেশে খাদ্য নিরাপত্তা নিশ্চিত করতে একটি কৌশলগত পরিকল্পনা তৈরি করেছে। কৌশলগত পরিকল্পনা BFSA এর দৃষ্টি, মিশন, মূল্যবোধ এবং উদ্দেশ্যগুলিকে রূপরেখা দেয়। পরিকল্পনাটি BFSA ওয়েবসাইটে 'কৌশলগত পরিকল্পনা' বিভাগের অধীনে উপলব্ধ।এখানে পরিকল্পনায় উল্লিখিত কিছু মূল কৌশল রয়েছে:
            • খাদ্য নিরাপত্তা মান এবং নির্দেশিকা উন্নয়ন এবং বাস্তবায়ন
            • খাদ্য নিরাপত্তার জন্য নিয়ন্ত্রক কাঠামোকে শক্তিশালী করা
            • খাদ্য নিরাপত্তা নজরদারি এবং পর্যবেক্ষণ ব্যবস্থা উন্নত করা
            • খাদ্য নিরাপত্তা বিষয়ে জনসচেতনতা ও শিক্ষার প্রচার
            • খাদ্য নিরাপত্তা ব্যবস্থাপনায় BFSA এবং স্টেকহোল্ডারদের ক্ষমতা জোরদার করা
            • খাদ্য নিরাপত্তা বিষয়ে আন্তর্জাতিক সহযোগিতা ও সহযোগিতা জোরদার করা ",

            'goals' => "Bangladesh Food Safety Authority (BFSA) has identified several goals that aim to ensure safe and nutritious food for all citizens of Bangladesh. These goals are listed in the BFSA's strategic plan, which is available on their website under the 'Strategic Plan' section. Here are the key goals of BFSA: Ensuring the safety and quality of food products throughout the food supply chain Strengthening the regulatory framework for food safety in Bangladesh Building the capacity of BFSA and stakeholders in food safety management Enhancing the awareness and knowledge of the public on food safety issues Developing and implementing science-based food safety standards and guidelines Enhancing the surveillance and monitoring systems for food safety Strengthening the international cooperation and collaboration on food safety.",

            'goals_bn' => "বাংলাদেশ নিরাপত্তা খাদ্য কর্তৃপক্ষ বেশ কয়েকটি লক্ষ্য চিহ্নিত করেছে যার লক্ষ্য বাংলাদেশের সকল নাগরিকের জন্য নিরাপদ ও পুষ্টিকর খাদ্য নিশ্চিত করা। এই লক্ষ্যগুলি BFSA এর কৌশলগত পরিকল্পনায় তালিকাভুক্ত করা হয়েছে, যা 'কৌশলগত পরিকল্পনা' বিভাগের অধীনে তাদের ওয়েবসাইটে উপলব্ধ।
            এখানে BFSA এর মূল লক্ষ্যগুলি রয়েছে:
             খাদ্য সরবরাহ শৃঙ্খল জুড়ে খাদ্য পণ্যের নিরাপত্তা এবং গুণমান নিশ্চিত করা
            বাংলাদেশে খাদ্য নিরাপত্তার জন্য নিয়ন্ত্রক কাঠামোকে শক্তিশালী করা
             খাদ্য নিরাপত্তা ব্যবস্থাপনায় BFSA এবং স্টেকহোল্ডারদের সক্ষমতা তৈরি করা
             খাদ্য নিরাপত্তা সংক্রান্ত বিষয়ে জনগণের সচেতনতা ও জ্ঞান বৃদ্ধি করা
             বিজ্ঞান-ভিত্তিক খাদ্য নিরাপত্তা মান এবং নির্দেশিকা বিকাশ এবং বাস্তবায়ন
             খাদ্য নিরাপত্তার জন্য নজরদারি এবং পর্যবেক্ষণ ব্যবস্থা উন্নত করা
             খাদ্য নিরাপত্তা বিষয়ে আন্তর্জাতিক সহযোগিতা ও সহযোগিতা জোরদার করা"
        ]);
    }
}
