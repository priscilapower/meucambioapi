<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    /**
     * @return void
     */
    public function testNewsIndex()
    {
        $this->get('/api/news')
            ->assertOk()
            ->assertJsonStructure(
                [
                    "current_page",
                    "data",
                    "first_page_url",
                    "from",
                    "last_page",
                    "last_page_url",
                    "next_page_url",
                    "path",
                    "per_page",
                    "prev_page_url",
                    "to",
                    "total"
                ]
            );
    }

    /**
     * @return void
     */
    public function testNewsIndexPageRight()
    {
        $this->get('/api/news?page=2')
            ->assertOk()
            ->assertJsonStructure(
                [
                    "current_page",
                    "data",
                    "first_page_url",
                    "from",
                    "last_page",
                    "last_page_url",
                    "next_page_url",
                    "path",
                    "per_page",
                    "prev_page_url",
                    "to",
                    "total"
                ]
            );
    }

    /**
     * @return void
     */
    public function testNewsIndexPageWrong()
    {
        $this->get('/api/news?page=255')
            ->assertOk()
            ->assertJsonStructure(
                [
                    "current_page",
                    "data",
                    "first_page_url",
                    "from",
                    "last_page",
                    "last_page_url",
                    "next_page_url",
                    "path",
                    "per_page",
                    "prev_page_url",
                    "to",
                    "total"
                ]
            );
    }

    /**
     * @return void
     */
    public function testNewsIndexPageString()
    {
        $this->get('/api/news?page=string')
            ->assertStatus(500)
            ->assertSeeText('O número da página precisa ser um inteiro');
    }

    /**
     * @return void
     */
    public function testNewsView()
    {
        $this->get('/api/news/5')
            ->assertOk()
            ->assertJsonStructure(
                [
                    "id",
                    "content",
                    "created_at",
                    "updated_at",
                ]
            );
    }

    /**
     * @return void
     */
    public function testNewsViewInvalidId()
    {
        $this->get('/api/news/c7ce76ce34f')
            ->assertOk();
    }

    public function testLoad()
    {
        $this->get('/api/load')
            ->assertOk();
    }

    public function testLoadWrong()
    {
        $this->get('/api/load/4')
            ->assertNotFound();
    }
}
