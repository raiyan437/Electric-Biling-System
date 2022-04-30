<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Connection;
use App\Bill;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function testCustomerDashboard()
    {
        $customeruser = User::create(['name'=>'Customer User', 'email'=>'customer@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_dashboard'));
        $response->assertStatus(200);
    }

    public function testCustomerChangePassword()
    {
        $customeruser = User::create(['name'=>'Customer User', 'email'=>'customer@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_changepassword'));
        $response->assertStatus(200);
    }

    public function testCustomerDueBills()
    {
        $customeruser = User::create(['name'=>'Customer User', 'email'=>'customer@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_duebills'));
        $response->assertStatus(200);
    }

    public function testCustomerPayHistory()
    {
        $customeruser = User::create(['name'=>'Customer User', 'email'=>'customer@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_payhistory'));
        $response->assertStatus(200);
    }

}
