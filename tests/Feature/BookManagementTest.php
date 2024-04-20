<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_book()
    {
        $response = $this->post(route('books.store'), [
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'published_date' => '2022-04-20',
        ]);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', [
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'published_date' => '2022-04-20',
        ]);
    }

    /** @test */
    public function a_user_can_view_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('books.show', $book->id));

        $response->assertSee($book->title)
                 ->assertSee($book->author)
                 ->assertSee($book->isbn)
                 ->assertSee($book->published_date);
    }

    /** @test */
    public function a_user_can_edit_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->put(route('books.update', $book->id), [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'isbn' => '0987654321',
            'published_date' => '2022-05-20',
        ]);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'isbn' => '0987654321',
            'published_date' => '2022-05-20',
        ]);
    }

    /** @test */
    public function a_user_can_delete_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertRedirect(route('books.index'));
        $this->assertSoftDeleted('books', ['id' => $book->id]);
    }
}
