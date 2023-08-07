<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => 'password123',
        ];

        // Send a POST request to the 'store' route (named 'crud.store') with the form data and CSRF token
        $response = $this->post(route('crud.store'), $data);

        // Assert that the response is a redirect (status code 302)
        $response->assertStatus(302);

        // Assert that the student data has been saved to the database
        $this->assertDatabaseHas('students', $data);

        // Assert that the redirect location is '/crud' (named 'crud.index')
        $response->assertRedirect(route('crud.index'));

        // Assert that the session has a 'completed' flash message with the correct value
        $this->assertSessionHas('completed', 'Student has been saved!');
    }
}
