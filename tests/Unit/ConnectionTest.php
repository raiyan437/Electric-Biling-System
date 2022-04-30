<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use App\User;

class ConnectionTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminSaveConnections()
    {
        $adminuser2 = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser2);
        $response = $this->post(route('admin_saveconnection'), array(
            'appname'=>'Test Applicant',
            'nid'=>'1238544679664',
            'email'=>'test@apply.com',
            'gender'=>'Male',
            'conaddress'=>'ABC Road, XYZ',
            'contactno'=>'0122334455',
            'billmonth'=>'January',
            'appdate'=>'2022-01-07',
        ));
        $response->assertSessionHas('success');
    }

    public function testAdminDeleteConnections()
    {
        $adminuser2 = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser2);
        $response = $this->post(route('admin_deleteconnection'), array(
            'cid'=>'10',
            'email'=>'test@apply.com'
        ));
        $response->assertSessionHas('success');
    }
}
