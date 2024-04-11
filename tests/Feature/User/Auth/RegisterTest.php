<?php

namespace Tests\Feature\User\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker,
        RefreshDatabase;


    public function test_user_can_see_register_form(): void
    {
        $response = $this->get(route('auth.register.form'));

        $response->assertStatus(200);
    }


    public function test_user_can_register(): void
    {

        $response = $this->post(route('auth.register'), [
            'username' => 'username',
            'email'    => 'email@gmail.com',
            'password' => '12344321',
            'password_confirmation' => '12344321',
        ]);

        $response->assertRedirect(route('site.index'));

        $this->assertCount(1, User::all());
    }

    // public function user_must_be_verify_account()
    // {
    //     $this->post(route('register'), [
    //         'username' => '',
    //         'email'    => 'email@gmail.com',
    //         'password' => '12344321',
    //         'password_confirmation' => '12344321',
    //     ]);

    //     $response = $this->get(route('site.index'));

    //     $response->assertRedirect(route('verification'));
    // }

    // public function test_verified_user_can_see_home()
    // {
    //     $this->post(route('register'), [
    //         'username' => '',
    //         'email'    => 'email@gmail.com',
    //         'password' => '12344321',
    //         'password_confirmation' => '12344321',
    //     ]);

    //     $this->assertAuthenticated();

    //     auth()->user()->markEmailAsVerified();

    //     $response = $this->get(route('site.index'));

    //     $response->assertOk();
    // }
}
