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
        $this->get('/news')
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
        $this->get('/news?page=2')
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
        $this->get('/news?page=255')
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
        $this->get('/news?page=string')
            ->assertStatus(500)
            ->assertSeeText('O número da página precisa ser um inteiro');
    }

    /**
     * @return void
     */
    public function testNewsView()
    {
        $this->get('/news/a58f28a32380dc7908181df518359954')
            ->assertOk()
            ->assertJsonStructure(
                [
                    "title",
                    "link",
                    "guid",
                    "description",
                    "category",
                    "pubDate",
                ]
            );
    }

    /**
     * @return void
     */
    public function testNewsViewInvalidId()
    {
        $this->get('/news/9c7ce76ce34f')
            ->assertOk()
            ->assertJsonStructure(
                []
            );
    }
}
