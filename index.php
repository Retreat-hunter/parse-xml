<?php

$file_url = "http://feeds.abcnews.com/abcnews/usheadlines";

$content = file_get_contents($file_url);
if (!$content) {
    echo "Failed to fetch news. Please try again later.";
    exit;
}

$stories = simplexml_load_string($content);
if (!$stories) {
    echo "Failed to parse news data. Please try again later.";
    exit;
}

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>ABC News Headlines</title>";
echo "<link rel='stylesheet' href='assets/style.css'>";
echo "</head>";
echo "<body>";

echo "<div class='container'>";

foreach ($stories->channel->item as $item) {
    $title = (string)$item->title;
    $link = (string)$item->link;
    $pubDate = date("F j, Y", strtotime((string)$item->pubDate));
    $description = (string)$item->description;

    echo "<h2><a href=\"$link\">$title</a></h2>";
    echo "<p><strong>Published Date:</strong> $pubDate</p>";
    echo "<p><strong>Summary:</strong> $description</p>";
    echo "<p><a href=\"$link\">Read more</a></p>";
    echo "<hr>";
}

echo "</div>"; // close container

echo "</body>";
echo "</html>";

?>
