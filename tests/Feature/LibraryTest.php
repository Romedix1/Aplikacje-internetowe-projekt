<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Loan;

class LibraryTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/katalog');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_borrow_available_book()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $copy = BookCopy::factory()->create([
            'book_id' => $book->id,
            'status' => 'available'
        ]);

        $response = $this->actingAs($user)->post('/wypozycz', ['book_copy_id' => $copy->id]);

        $this->assertDatabaseHas('loans', [
            'user_id' => $user->id,
            'book_copy_id' => $copy->id
        ]);

        $this->assertDatabaseHas('book_copies', [
            'id' => $copy->id,
            'status' => 'loaned'
        ]);
    }

    public function test_regular_user_cannot_access_staff_panel()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/panel-pracownika');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_staff_panel()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/panel-pracownika');

        $response->assertStatus(200);
    }
}