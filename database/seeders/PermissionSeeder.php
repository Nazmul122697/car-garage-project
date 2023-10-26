<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*~~~~~~~~~~~~~~ For User Part~~~~~~~~~~~~~~*/
        $moduleDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $moduleDashboard->id,
            'name'      => 'Access Dashboard',
            'slug'      => 'dashboard'
        ]);


        /*~~~~~~~~~~~~~~ For Role Part~~~~~~~~~~~~~~*/
        $moduleRole = Module::updateOrCreate(['name' => 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Access Role',
            'slug'      => 'roles.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Create Role',
            'slug'      => 'roles.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Create Role',
            'slug'      => 'roles.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Edit Role',
            'slug'      => 'roles.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleRole->id,
            'name'      => 'Delete Role',
            'slug'      => 'roles.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For User Part~~~~~~~~~~~~~~*/
        $moduleUser = Module::updateOrCreate(['name' => 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Access User',
            'slug'      => 'users.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Create User',
            'slug'      => 'users.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Show User',
            'slug'      => 'users.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Edit User',
            'slug'      => 'users.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUser->id,
            'name'      => 'Delete User',
            'slug'      => 'users.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For Customer Part~~~~~~~~~~~~~~*/
        $moduleCustomer = Module::updateOrCreate(['name' => 'Customer Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name'      => 'Access Customer',
            'slug'      => 'customers.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name'      => 'Show Customer',
            'slug'      => 'customers.show'
        ]);


        /*~~~~~~~~~~~~~~ For Application Part~~~~~~~~~~~~~~*/
        $moduleApplication = Module::updateOrCreate(['name' => 'Application Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleApplication->id,
            'name'      => 'Access Application',
            'slug'      => 'application.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApplication->id,
            'name'      => 'Create Application',
            'slug'      => 'application.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApplication->id,
            'name'      => 'Show Application',
            'slug'      => 'application.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApplication->id,
            'name'      => 'Edit Application',
            'slug'      => 'application.edit'
        ]);


        /*~~~~~~~~~~~~~~ For Certificate Part~~~~~~~~~~~~~~*/
        $moduleCertificate = Module::updateOrCreate(['name' => 'Certificate Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleCertificate->id,
            'name'      => 'My Certificates',
            'slug'      => 'certificate.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCertificate->id,
            'name'      => 'View Certificate',
            'slug'      => 'certificate.view'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleCertificate->id,
            'name'      => 'Certificate Change Request',
            'slug'      => 'certificate.change.request'
        ]);

        /*~~~~~~~~~~~~~~ For Area Setup Part~~~~~~~~~~~~~~*/
        $moduleAreaSetup = Module::updateOrCreate(['name' => 'Area Setup Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAreaSetup->id,
            'name'      => 'Access Country',
            'slug'      => 'countries.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAreaSetup->id,
            'name'      => 'Access Division',
            'slug'      => 'divisions.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAreaSetup->id,
            'name'      => 'Access District',
            'slug'      => 'districts.index'
        ]);

        /*~~~~~~~~~~~~~~ For Type of Goods Part~~~~~~~~~~~~~~*/
        $moduleTypeGoods = Module::updateOrCreate(['name' => 'Type of Goods Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Access Type of Goods',
            'slug'      => 'type-goods.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Create Type of Goods',
            'slug'      => 'type-goods.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Edit Type of Goods',
            'slug'      => 'type-goods.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Delete Type of Goods',
            'slug'      => 'type-goods.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For Fee Structure Part~~~~~~~~~~~~~~*/
        $moduleFeeStructure = Module::updateOrCreate(['name' => 'Fee Structure Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleFeeStructure->id,
            'name'      => 'Access Fee Structure',
            'slug'      => 'fee-structures.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFeeStructure->id,
            'name'      => 'Create Fee Structure',
            'slug'      => 'fee-structures.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFeeStructure->id,
            'name'      => 'Edit Fee Structure',
            'slug'      => 'fee-structures.edit'
        ]);


         /*~~~~~~~~~~~~~~ For Type of Goods Part~~~~~~~~~~~~~~*/
        $moduleTypeGoods = Module::updateOrCreate(['name' => 'Type of Goods Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Access Type of Goods',
            'slug'      => 'type-goods.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Create Type of Goods',
            'slug'      => 'type-goods.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Edit Type of Goods',
            'slug'      => 'type-goods.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTypeGoods->id,
            'name'      => 'Delete Type of Goods',
            'slug'      => 'type-goods.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For Slider Part~~~~~~~~~~~~~~*/
        $moduleSlider = Module::updateOrCreate(['name' => 'Slider Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleSlider->id,
            'name'      => 'Access Slider',
            'slug'      => 'sliders.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleSlider->id,
            'name'      => 'Create Slider',
            'slug'      => 'sliders.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleSlider->id,
            'name'      => 'Edit Slider',
            'slug'      => 'sliders.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleSlider->id,
            'name'      => 'Delete Slider',
            'slug'      => 'sliders.destroy'
        ]);

        /*~~~~~~~~~~~~~~ For Blog Part~~~~~~~~~~~~~~*/
        $moduleBlog = Module::updateOrCreate(['name' => 'Blog Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleBlog->id,
            'name'      => 'Access Blog',
            'slug'      => 'blogs.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBlog->id,
            'name'      => 'Create Blog',
            'slug'      => 'blogs.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBlog->id,
            'name'      => 'Show Blog',
            'slug'      => 'blogs.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBlog->id,
            'name'      => 'Edit Blog',
            'slug'      => 'blogs.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleBlog->id,
            'name'      => 'Delete Blog',
            'slug'      => 'blogs.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For Tutorial Part~~~~~~~~~~~~~~*/
        $moduleTutorial = Module::updateOrCreate(['name' => 'Tutorial Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleTutorial->id,
            'name'      => 'Access Tutorial',
            'slug'      => 'tutorials.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTutorial->id,
            'name'      => 'Create Tutorial',
            'slug'      => 'tutorials.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTutorial->id,
            'name'      => 'Show Tutorial',
            'slug'      => 'tutorials.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTutorial->id,
            'name'      => 'Edit Tutorial',
            'slug'      => 'tutorials.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleTutorial->id,
            'name'      => 'Delete Tutorial',
            'slug'      => 'tutorials.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For User Manual Part~~~~~~~~~~~~~~*/
        $moduleUserManual = Module::updateOrCreate(['name' => 'User Manual Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleUserManual->id,
            'name'      => 'Access User Manual',
            'slug'      => 'user-manuals.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUserManual->id,
            'name'      => 'Create User Manual',
            'slug'      => 'user-manuals.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUserManual->id,
            'name'      => 'Show User Manual',
            'slug'      => 'user-manuals.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUserManual->id,
            'name'      => 'Edit User Manual',
            'slug'      => 'user-manuals.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleUserManual->id,
            'name'      => 'Delete User Manual',
            'slug'      => 'user-manuals.destroy'
        ]);

        /*~~~~~~~~~~~~~~ For Mode of Transport Part~~~~~~~~~~~~~~*/
        $moduleModeTransport = Module::updateOrCreate(['name' => 'Mode of Transport Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleModeTransport->id,
            'name'      => 'Access Mode of Transport',
            'slug'      => 'transport-modes.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleModeTransport->id,
            'name'      => 'Create Mode of Transport',
            'slug'      => 'transport-modes.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleModeTransport->id,
            'name'      => 'Edit Mode of Transport',
            'slug'      => 'transport-modes.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleModeTransport->id,
            'name'      => 'Delete Mode of Transport',
            'slug'      => 'transport-modes.destroy'
        ]);

        /*~~~~~~~~~~~~~~ For Change Request Fee Part~~~~~~~~~~~~~~*/
        $moduleChangeRequestFee = Module::updateOrCreate(['name' => 'Change Request Fee Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleChangeRequestFee->id,
            'name'      => 'Access Change Request Fee',
            'slug'      => 'change-request-fees.index'
        ]);

        /*~~~~~~~~~~~~~~ For About Part~~~~~~~~~~~~~~*/
        $moduleAbout = Module::updateOrCreate(['name' => 'About Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAbout->id,
            'name'      => 'Access About',
            'slug'      => 'abouts.index'
        ]);

        /*~~~~~~~~~~~~~~ For Term Service Part~~~~~~~~~~~~~~*/
        $moduleTermService = Module::updateOrCreate(['name' => 'Term Service Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleTermService->id,
            'name'      => 'Access Term Service',
            'slug'      => 'term-services.index'
        ]);

        /*~~~~~~~~~~~~~~ For Website Part~~~~~~~~~~~~~~*/
        $moduleWebsite = Module::updateOrCreate(['name' => 'Website Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleWebsite->id,
            'name'      => 'Access Website',
            'slug'      => 'websites.index'
        ]);

        /*~~~~~~~~~~~~~~ For FAQ~~~~~~~~~~~~~~*/
        $moduleFaq = Module::updateOrCreate(['name' => 'FAQ Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleFaq->id,
            'name'      => 'Access Faq',
            'slug'      => 'faq.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFaq->id,
            'name'      => 'Create Faq',
            'slug'      => 'faq.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFaq->id,
            'name'      => 'Show Faq',
            'slug'      => 'faq.show'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFaq->id,
            'name'      => 'Edit Faq',
            'slug'      => 'faq.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleFaq->id,
            'name'      => 'Delete Faq',
            'slug'      => 'faq.destroy'
        ]);


        /*~~~~~~~~~~~~~~ For Help Line~~~~~~~~~~~~~~*/
        $moduleHelpLine = Module::updateOrCreate(['name' => 'Help Line Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleHelpLine->id,
            'name'      => 'Help Line Request',
            'slug'      => 'help.line'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleHelpLine->id,
            'name'      => 'Help Line Completed',
            'slug'      => 'help.line.complete'
        ]);

    }
}
