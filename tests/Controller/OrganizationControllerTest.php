<?php

namespace Tests\Controller;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrganizationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testListOrganizations () {
        $response = $this->get(route('organizations.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => ['organizations']
            ]);
    }

    public function testCreateOrganization () {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $newOrganization = ['name' => 'Organization Name'];

        $response = $this->post(route('organizations.store'), $newOrganization);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'organization' => ['name']
                ]
            ]);
    }


}