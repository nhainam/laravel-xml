<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Console\Commands;

use App\Constants;
use App\Contracts\Categories;
use App\Contracts\Channels;
use App\Contracts\Posts;
use App\Helpers\Date;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:SampleFeeds {paths?} {--logfile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from xml from files or urls. Its separated by comma.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Channels $channel, Categories $category, Posts $post)
    {
        $inputPaths = $this->argument('paths');
        $logFile = $this->option('logfile');
        $paths = explode(",", $inputPaths);
        foreach ($paths as $path) {
            $this->line(" Importing URL: " . $path);

            // Get data from the link
            $postXMLData = file_get_contents($path);
            $xml = simplexml_load_string($postXMLData) or die("Error: Cannot create object");

            // Validate Channel
            $infoChannel = $channel->findByCode($path);
            $dataUpdateChannel = $this->fixDataChannel($xml->channel);
            $dataUpdateChannel['category_id'] = 0;
            if ($xml->channel->category) {
                $arrayCategories = explode('/', $xml->channel->category);
                $dataUpdateChannel['category_id'] = $this->getStringCategories($category, $arrayCategories);
            }
            if (!$infoChannel) {
                // @TODO: Need to verify when it can't import to system.
                $dataUpdateChannel['code'] = $path;
                $infoChannel = $channel->create($dataUpdateChannel);
                $this->line("\nAdded channel:" . $dataUpdateChannel['name']);
                $logFile ? Log::info("\nAdded channel:" . json_encode($dataUpdateChannel)) : " ";
            } else {
                $channel->update($infoChannel, $dataUpdateChannel);
                $this->line("\nUpdated channel:" . $dataUpdateChannel['name']);
                $logFile ? Log::info("\nUpdated channel:" . json_encode($dataUpdateChannel)) : " ";
            }

            // Posts
            $channelId = $infoChannel->id;
            $items = $xml->channel->item;
            $bar = $this->output->createProgressBar(count($items));
            $bar->start();
            foreach ($items as $item) {
                $fixedItem = $this->fixDataPost($item);
                $postName = $fixedItem['name'];
                $fixedItem['channel_id'] = $channelId;
                $fixedItem['category_id'] = 0;
                if ($item->category) {
                    $arrayCategories = explode('/', $item->category);
                    $fixedItem['category_id'] = $this->getStringCategories($category, $arrayCategories);
                }
                $infoPost = $post->findByName($postName);
                if (!$infoPost) {
                    $post->create($fixedItem);
                    $this->line(" Added:". $fixedItem['name']);
                    $logFile ? Log::info(" Added:". json_encode($fixedItem)) : "";
                } else {
                    $post->update($infoPost, $fixedItem);
                    $this->line(" Updated:". $fixedItem['name']);
                    $logFile ? Log::info(" Updated:". json_encode($fixedItem)) : "";
                }
                $bar->advance();
            }

            // Image
            // @TODO: Collect image's data for Post and Channel.
            $bar->finish();
        }

        $this->line("\nDone");
    }

    /**
     * @param Categories $category
     * @param array $arrayCategoryNames
     * @return string
     */
    private function getStringCategories(Categories $category, array $arrayCategoryNames): string
    {
        $arrayCategoryIds = [];
        foreach ($arrayCategoryNames as $itemCategoryName) {
            $objectCategory = $category->findByName(trim($itemCategoryName));
            if (!$objectCategory) {
                $objectCategory = $category->create([
                    'name' => trim($itemCategoryName),
                    'user_id' => Constants::USER_FOR_IMPORT_COMMAND
                ]);
            }
            $arrayCategoryIds[] = $objectCategory->id;
        }
        return "," . implode(',', $arrayCategoryIds) . ",";
    }

    /**
     * @param $post
     * @return array
     */
    private function fixDataPost($post): array
    {
        return [
            'name' => $post->title,
            'description' => $post->description,
            'user_id' => Constants::USER_FOR_IMPORT_COMMAND,
            'comments' => $post->comments,
            'published_date' => Date::convertToUTC($post->pubDate),
            'link' => $post->link,
            'guid' => $post->guid ? $post->guid : null,
            'is_permalink' => $post->isPermaLink ? $post->isPermaLink : false
        ];
    }

    /**
     * @param $channel
     * @return array
     */
    private function fixDataChannel($channel): array
    {

        return [
            'name' => $channel->title,
            'description' => $channel->description,
            'link' => $channel->link,
            'category' => $channel->category,
            'copyright' => $channel->copyright,
            'docs' => $channel->docs,
            'last_build_date' => Date::convertToUTC($channel->lastBuildDate),
            'managing_editor' => $channel->managingEditor,
            'published_date' => Date::convertToUTC($channel->pubDate),
            'web_master' => $channel->webMaster,
            'generator' => $channel->generator,
            'user_id' => Constants::USER_FOR_IMPORT_COMMAND
        ];

    }
}
