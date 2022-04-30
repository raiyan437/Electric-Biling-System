<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use App\User;

class AdminBasicTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoginPage()
    {
        $response = $this->get("/");
        $response->assertRedirect(route('login'));
    }

    public function testAdminDashboard()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_dashboard'));
        $response->assertStatus(200);
    }

    public function testAdminChangePassword()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_changepassword'));
        $response->assertStatus(200);
    }

    public function testAdminNewConnection()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_newconnection'));
        $response->assertStatus(200);
    }

    public function testAdminConnectionList()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_connectionlist'));
        $response->assertStatus(200);
    }

    public function testAdminBillEntry()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_billentry'));
        $response->assertStatus(200);
    }

    public function testAdminDueBills()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_duebills'));
        $response->assertStatus(200);
    }

    public function testAdminSaveBills()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_billsave'), array(
            'conid'=>10,
            'billmonth'=>'January',
            'billyear'=>2020,
            'amount'=>500
        ));
        $response->assertSessionHas('success');
    }

    public function testPaymentRequests()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_payrequests'));
        $response->assertStatus(200);
    }

    public function testPaymentHistory()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_payhistory'));
        $response->assertStatus(200);
    }


}
