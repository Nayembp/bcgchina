<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Auth\Rolepermission;
use App\Livewire\Auth\EditRolePermission;
use App\Livewire\Backend\Users\Admins\{AdminIndex, AdminAdd, AdminEdit};
use App\Livewire\Backend\Donation\{DonationCreate, DonationEdit, DonationIndex};

use App\Livewire\Backend\Activity\{ActivityCreate, ActivityEdit, ActivityIndex};
use App\Livewire\Backend\Activity\Type\{TypeCreate, TypeEdit, TypeIndex};
use App\Livewire\Backend\NationalDays\{DayIndex, DayCreate, DayEdit};
use App\Livewire\Backend\Gallery\{GalleryManager, PhotoManager, GalleryView};
use App\Livewire\Settings\Globalsettings\AppSettings;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('settings/globalsettings', AppSettings::class)->name('settings.globalsettings')->middleware('can:settings.view');
    Route::get('setting/rolepermission', Rolepermission::class)->name('rolepermission.index')->middleware('can:settings.view'); 
    Route::get('setting/{id}/edit-permissions', EditRolePermission::class)->name('rolepermission.edit')->middleware('can:settings.edit');;
    

    Route::get('backend/user/index', AdminIndex::class)->name('admin.index')->middleware('can:user.view');
    Route::get('user/add', AdminAdd::class)->name('admin.add')->middleware('can:user.add');
    Route::get('user/{id}/edit-admin', AdminEdit::class)->name('admin.edit')->middleware('can:user.edit');
   
   
    Route::prefix('backend/donation')->group(function () {
        Route::get('index',  DonationIndex::class)->name('donation.index')->middleware('can:donation.view');
        Route::get('create', DonationCreate::class)->name('donation.create')->middleware('can:donation.add');
        Route::get('edit/{id}', DonationEdit::class)->name('donation.edit')->middleware('can:donation.edit');
    });

    Route::prefix('backend/activity')->group(function () {
        Route::get('index', ActivityIndex::class)->name('activity.index');
        Route::get('create', ActivityCreate::class)->name('activity.create');
        Route::get('edit/{id}', ActivityEdit::class)->name('activity.edit');
    });

    Route::prefix('backend/activity/type')->group(function () {
        Route::get('index', TypeIndex::class)->name('activity.type.index');
        Route::get('create', TypeCreate::class)->name('activity.type.create');
        Route::get('edit/{id}', TypeEdit::class)->name('activity.type.edit');
    });


    Route::prefix('backend/national-day')->group(function () {
        Route::get('index', DayIndex::class)->name('national.day.index');
        Route::get('create', DayCreate::class)->name('national.day.create');
        Route::get('edit/{id}', DayEdit::class)->name('national.day.edit');
    });
    

    Route::prefix('backend/photo-gallery')->group(function () {
        Route::get('index', GalleryView::class)->name('gallery.view');
        Route::get('manage', GalleryManager::class)->name('gallery.manage');        
        Route::get('photos', PhotoManager::class)->name('gallery.photos');
    });



});


