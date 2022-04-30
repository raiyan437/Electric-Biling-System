<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use App\User;

class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    public function testAcceptPayment()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_acceptpayment'), array(
            'pid'=>'1',
            'bid'=>'1'
        ));
        $response->assertSessionHas('success');
    }

    public function testRejectPayment()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_acceptpayment'), array(
            'pid'=>'1'
        ));
        $response->assertSessionHas('success');
    }
}
