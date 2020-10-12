<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Organisation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;




class UserTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function once_user_model_uuid_is_set_it_the_model_cannot_change_it()
    {
        $user = User::factory(1)->create()->first();
        $user->uuid = 'changed value';
        $this->assertTrue($user->uuid !== 'changed value');
    }

    /** @test */
    public function a_users_is_admin_attribute_cannot_be_changed()
    {
        $user = User::factory(1)->make(['is_admin' => 0])->first();
        $user->is_admin = 1;  // try to turn a manager into a sysadmin    
        $this->assertTrue($user->is_admin === 0);

        $user2 = User::factory(1)->make(['is_admin' => 1])->first();
        $user2->is_admin = 0;  // try to turn sysdamin into manager      
        $this->assertTrue($user2->is_admin === 1);
    }

    /** @test */
    public function a_user_can_determine_their_role()
    {
        $user = User::factory(1)->make(['is_admin' => 1])->first();
        $this->assertTrue($user->checkRole('system-administrator'));
        $this->assertFalse($user->checkRole('account-manager'));

        $user2 = User::factory(1)->make(['is_admin' => 0])->first();
        $this->assertTrue($user2->hasRole('account-manager'));
        $this->assertFalse($user2->hasRole('system_administrator'));
    }

    /** @test */
    public function an_account_manager_can_have_zero_or_more_organisations()
    {
        $user = User::factory(1)->create(['is_admin' => 0])->first();
        $this->assertTrue($user->organisations()->get()->count() == 0);

        $organisation = Organisation::factory(1)->create()
            ->first()->managers()->attach($user->id);
        $this->assertTrue($user->organisations()->get()->count() == 1);

        $organisation = Organisation::factory(1)->create()
            ->first()->managers()->attach($user->id);
        $this->assertTrue($user->organisations()->get()->count() == 2);

    }

    /** @test */
    public function a_user_cannot_delete_an_organisation()
    {
        $user = User::factory(1)->create(['is_admin' => 0])->first();
        $this->assertTrue($user->organisations()->get()->count() == 0);

        $organisation = Organisation::factory(1)->create()
            ->first()->managers()->attach($user->id);
        $this->assertTrue($user->organisations()->get()->count() == 1);

        $user->organisations()->first()->delete();

        $this->assertTrue($user->organisations()->get()->count() == 1);

    }
}
