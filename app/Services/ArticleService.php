<?php

namespace App\Services;

use SimplePie\Item;
use App\Models\Import;
use App\Models\Article;
use SimplePie\SimplePie;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    /**
     * Get all Articles.
     * 
     * @return mixed
     */
    public function getAllArticles(): mixed
    {
        //Cache the result for 3 minutes
        $articles = Cache::remember('articles', now()->addMinutes(3), function () {
            return Article::all();
        });

        return $articles;
    }


    /**
     * Import and Store list of Articles from a RSS feed.
     * 
     * @param string $siteRssUrl
     * @return void
     */
    public function importArticlesFrom(string $siteRssUrl): void
    {
        $feed = new SimplePie();
        $feed->set_feed_url($siteRssUrl);
        $feed->enable_cache(false);
        $feed->init();
        $raw = $feed->get_raw_data();
        $import = Import::create([
            'importDate' => now(),
            'rawContent' => $raw,
        ]);

        collect($feed->get_items())->map(function ($item) use ($import) {
            $article = Article::updateOrCreate(
                ['externalId' => $item->get_id()],
                [
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'publicationDate' => $item->get_date('Y-m-d H:i:s'),
                    'link' => $item->get_permalink(),
                    'mainPicture' => $this->getMainPicture($item),
                    'import_id' => $import->id,
                ]
            );

            return $article;
        });

        Cache::flush();
    }

    /**
     * Helper function to get the main picture of an Item.
     * 
     * @param SimplePie_Item $item
     * @return string|null
     */

    private function getMainPicture(Item $item): ?string
    {
        $enclosures = $item->get_enclosures();
        if (count($enclosures) > 0) {
            return $enclosures[0]->get_link();
        }

        return null;
    }
}
