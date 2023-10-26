<?php

namespace Database\Seeders;

use App\Models\TermService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermService::create([
            "description" => "Website terms and conditions are a set of rules and regulations that govern the use of a website by its users. These terms and conditions usually cover a range of issues, including intellectual property rights, user conduct, disclaimers of liability, privacy policies, and other important legal provisions. Here are some key components that are typically included in website terms and conditions: Introduction: This section explains the purpose of the terms and conditions and provides a brief overview of the website and its services. Intellectual property rights: This section outlines the website's ownership of all content, logos, trademarks, and other intellectual property displayed on the website. User conduct: This section outlines the rules that users must follow when using the website. This includes rules related to prohibited activities, user-generated content, and compliance with applicable laws and regulations. Disclaimers of liability: This section limits the website's liability for any damages or losses incurred by users while using the website. Privacy policy: This section outlines the website's policy on collecting, using, and protecting user data. Termination: This section explains the circumstances under which the website may terminate a user's access to the website, as well as the consequences of termination. Governing law and jurisdiction: This section outlines the governing law that applies to the terms and conditions, as well as the jurisdiction in which any disputes will be resolved. It's important to note that website terms and conditions can vary depending on the type of website and the jurisdiction in which it operates. As such, it's always a good idea to consult with a legal professional when creating or updating website terms and conditions",
            "description_bn" => "ওয়েবসাইটের শর্তাবলী হল নিয়ম ও প্রবিধানের একটি সেট যা ব্যবহারকারীদের দ্বারা একটি ওয়েবসাইট ব্যবহার নিয়ন্ত্রণ করে। এই শর্তাবলী সাধারণত বুদ্ধিবৃত্তিক সম্পত্তি অধিকার, ব্যবহারকারীর আচরণ, দায় অস্বীকার, গোপনীয়তা নীতি এবং অন্যান্য গুরুত্বপূর্ণ আইনী বিধান সহ বিভিন্ন বিষয়কে কভার করে। এখানে কিছু মূল উপাদান রয়েছে যা সাধারণত ওয়েবসাইটের শর্তাবলীতে অন্তর্ভুক্ত করা হয়: ভূমিকা: এই বিভাগটি শর্তাবলীর উদ্দেশ্য ব্যাখ্যা করে এবং ওয়েবসাইট এবং এর পরিষেবাগুলির একটি সংক্ষিপ্ত বিবরণ প্রদান করে৷ বৌদ্ধিক সম্পত্তি অধিকার: এই বিভাগটি ওয়েবসাইটে প্রদর্শিত সমস্ত বিষয়বস্তু, লোগো, ট্রেডমার্ক এবং অন্যান্য বৌদ্ধিক সম্পত্তির ওয়েবসাইটের মালিকানার রূপরেখা দেয়। ব্যবহারকারীর আচরণ: এই বিভাগে ওয়েবসাইট ব্যবহার করার সময় ব্যবহারকারীদের অনুসরণ করা আবশ্যক নিয়মগুলির রূপরেখা দেওয়া হয়েছে। এর মধ্যে নিষিদ্ধ ক্রিয়াকলাপ, ব্যবহারকারী-উত্পাদিত সামগ্রী এবং প্রযোজ্য আইন ও প্রবিধানগুলির সাথে সম্মতি সম্পর্কিত নিয়ম অন্তর্ভুক্ত রয়েছে৷ দায়বদ্ধতার দাবিত্যাগ: এই বিভাগটি ওয়েবসাইট ব্যবহার করার সময় ব্যবহারকারীদের দ্বারা সংঘটিত কোনো ক্ষতি বা ক্ষতির জন্য ওয়েবসাইটের দায়বদ্ধতা সীমিত করে। গোপনীয়তা নীতি: এই বিভাগটি ব্যবহারকারীর ডেটা সংগ্রহ, ব্যবহার এবং সুরক্ষার বিষয়ে ওয়েবসাইটের নীতির রূপরেখা দেয়। সমাপ্তি: এই বিভাগটি ব্যাখ্যা করে যে কোন পরিস্থিতিতে ওয়েবসাইটটি ওয়েবসাইটটিতে ব্যবহারকারীর অ্যাক্সেস বাতিল করতে পারে, সেইসাথে সমাপ্তির পরিণতিগুলিও। গভর্নিং আইন এবং এখতিয়ার: এই বিভাগে নিয়ম ও শর্তাবলীতে প্রযোজ্য গভর্নিং আইনের রূপরেখা দেয়, সেইসাথে যে এখতিয়ারে কোনো বিবাদের সমাধান করা হবে। এটি লক্ষ্য করা গুরুত্বপূর্ণ যে ওয়েবসাইটের নিয়ম ও শর্তাবলী ওয়েবসাইটের ধরন এবং এটি যে এখতিয়ারে কাজ করে তার উপর নির্ভর করে পরিবর্তিত হতে পারে। যেমন, ওয়েবসাইটের নিয়ম ও শর্তাবলী তৈরি বা আপডেট করার সময় একজন আইনি পেশাদারের সাথে পরামর্শ করা সবসময়ই ভালো",
        ]);
    }
}
