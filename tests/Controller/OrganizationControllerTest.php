<?php

namespace Tests\Controller;

use App\Models\Organization;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrganizationControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $otherUser;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->otherUser = factory(User::class)->create();
    }

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
        $this->actingAs($this->user);

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

        $newOrganizationId = $response->json()['data']['organization']['id'];

        $this->assertNotNull(Organization::find($newOrganizationId));
    }

    public function testUpdateOrganization () {
        $this->actingAs($this->user);

        $org = factory(Organization::class)->create();

        $newName = 'Organization Updated Name';
        $updatedOrganization = [
            'name' => $newName
        ];

        $response = $this->put(route('organizations.update', ['id' => $org->id]), $updatedOrganization);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'organization' => ['name']
                ]
            ])
            ->assertJsonFragment(['name' => $newName]);
    }

    public function testUpdateOrganizationWithInvalidId () {
        $updatedOrganization = [
            'name' => 'Organization Updated Name'
        ];

        $response = $this->put(route('organizations.update', ['id' => 'invalid-id']), $updatedOrganization);

        $response->assertStatus(404);
    }

    public function testShowOrganization () {
        $this->actingAs($this->user);

        $org = factory(Organization::class)->create();

        $response = $this->get(route('organizations.show', ['id' => $org->id]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'organization' => ['name']
                ]
            ])
            ->assertJsonFragment(['name' => $org->name]);
    }

    public function testShowOrganizationWithInvalidId () {
        $response = $this->get(route('organizations.show', ['id' => 'invalid-id']));

        $response->assertStatus(404);
    }

    public function testDeleteOrganization () {
        $this->actingAs($this->user);

        $org = factory(Organization::class)->create();

        $response = $this->delete(route('organizations.destroy', ['id' => $org->id]));

        $response->assertStatus(200);

        $this->assertNull(Organization::find($org->id));
    }

    public function testDeleteOrganizationWithInvalidId () {
        $response = $this->delete(route('organizations.destroy', ['id' => 'invalid-id']));

        $response->assertStatus(404);
    }
}