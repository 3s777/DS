<?php

namespace Feature\Support\Traits;

use Domain\Shelf\Models\KitItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasSlugTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success_create_from_name_slug(): void
    {
        KitItem::create(['name' => 'Test Name']);

        $this->assertDatabaseHas('kit_items', [
            'slug' => 'test-name',
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_add_slug(): void
    {
        KitItem::create(['name' => 'Test Name', 'slug' => 'Test Slug']);

        $this->assertDatabaseHas('kit_items', [
            'slug' => 'test-slug',
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_update_slug(): void
    {
        $kitItem = KitItem::create(['name' => 'Test Name', 'slug' => 'Test Slug']);

        $this->assertDatabaseHas('kit_items', [
            'slug' => 'test-slug',
        ]);

        $kitItem->slug = 'New TEst $slug';
        $kitItem->save();

        $this->assertSame($kitItem->slug, 'new-test-slug');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_generate_unique_slug(): void
    {
        $kitItems = KitItem::factory(5)->create(['name' => 'Test Name', 'slug' => 'Test Slug']);

        $i = 0;
        foreach ($kitItems as $item) {
            if ($i > 0) {
                $this->assertSame($item->slug, 'test-slug-'.$i);
            } else {
                $this->assertSame($item->slug, 'test-slug');
            }

            $i++;
        }

        $kitItem2 = KitItem::where('slug', 'test-slug-2')->first();
        $kitItem2->slug = 'test-slug-2';
        $kitItem2->save();

        $this->assertSame($kitItem2->slug, 'test-slug-2');

        $kitItem2->slug = 'test-slug-3';
        $kitItem2->save();

        $this->assertSame($kitItem2->slug, 'test-slug-3-1');
    }
}
