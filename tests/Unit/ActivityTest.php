<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $activityData;

    /**
     * préparer les données avant chaque test
    */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->activityData = [
            'name' => 'Activité test',
            'description' => 'Ceci est une description de test pour une activité.',
            'link' => 'https://google.fr',
            'location' => 'Lieu de test',
            'date' => now()->addDays(7)->format('Y-m-d'),
            'start_time' => '10:00',
            'end_time' => '12:00',
            'sport_type' => 'Natation',
            'is_accessible_mobility' => true,
            'is_accessible_vision' => false,
            'is_accessible_hearing' => true,
            'is_accessible_cognitive' => false,
            'accessibility_details' => 'Quelques détails sur l’accessibilité',
            'contact_email' => 'test@exemple.com',
            'contact_phone' => '0123456789',
            'user_id' => $this->user->id
        ];
    }

    /**
     * test la création d'une activité dans la base de données
    */
    #[Test]
    public function it_can_create_an_activity()
    {
        $activity = Activity::create($this->activityData);

        $this->assertDatabaseHas('activities', [
            'id' => $activity->id,
            'name' => 'Activité test'
        ]);

        $this->assertEquals($this->user->id, $activity->user_id);
    }

    /**
     * test la récupération de l'activité dans la bdd
    */
    #[Test]
    public function it_can_read_an_activity()
    {
        $activity = Activity::create($this->activityData);

        $foundActivity = Activity::find($activity->id);

        $this->assertNotNull($foundActivity);
        $this->assertEquals('Activité test', $foundActivity->name);
        $this->assertEquals('Ceci est une description de test pour une activité.', $foundActivity->description);
    }

    /**
     * test la mise a jour des données d'une activité
    */
    #[Test]
    public function it_can_update_an_activity()
    {
        $activity = Activity::create($this->activityData);

        $updatedData = [
            'name' => 'Activité mise à jour',
            'description' => 'Ceci est une description mise à jour.'
        ];

        $activity->update($updatedData);

        $this->assertDatabaseHas('activities', [
            'id' => $activity->id,
            'name' => 'Activité mise à jour',
            'description' => 'Ceci est une description mise à jour.'
        ]);
    }

    /**
     * test la suppression d'une activité
    */
    #[Test]
    public function it_can_delete_an_activity()
    {
        $activity = Activity::create($this->activityData);

        $activityId = $activity->id;

        $activity->delete();

        $this->assertDatabaseMissing('activities', ['id' => $activityId]);
    }

    /**
     * vérifie que l'activité est bien liée a un utilisateur
    */
    #[Test]
    public function it_belongs_to_a_user()
    {
        $activity = Activity::create($this->activityData);

        $this->assertInstanceOf(User::class, $activity->user);
        $this->assertEquals($this->user->id, $activity->user->id);
    }

    /**
     * vérifie que les champs requis sont bien validés car ce sont des champs non nullable
    */
    #[Test]
    public function it_validates_required_fields()
    {
        $activity = new Activity();

        $rules = [
            'name' => 'required',
            'date' => 'required'
        ];

        $incompleteData = [
            'description' => 'Seulement une description'
        ];

        $validator = validator($incompleteData, $rules);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('name'));
        $this->assertTrue($validator->errors()->has('date'));
    }
}
