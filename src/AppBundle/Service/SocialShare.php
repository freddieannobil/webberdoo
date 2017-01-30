<?php
/**
 * Created by Freddie Annobil-Dooo.
 * Website: Webberdoo.co.uk
 */

namespace Webberdoo\AppBundle\Service;

class SocialShare
{

    public function facebook($page_url, $title)
    {
        $facebook = "http://www.facebook.com/sharer/sharer.php?u=$page_url&title=$title";

        $link = "<a href = '$facebook' target='_blank' class='button large facebook'><i class='fa fa-facebook fa-2x'></i></a>";

        return $link;
    }

    public function twitter($page_url, $title)
    {
        $url = "http://twitter.com/intent/tweet?status=$title+$page_url";

        $link = "<a href = '$url' target='_blank' class='button large twitter'><i class='fa fa-twitter fa-2x'></i></a>";

        return $link;
    }

    public function google_plus($page_url, $title = null)
    {
        $url = "https://plus.google.com/share?url=$page_url";

        $link = "<a href = '$url' target='_blank' class='button large google_plus'><i class='fa fa-google-plus fa-2x'></i></a>";

        return $link;
    }

    public function pinterest($page_url, $title = null)
    {
        $url = "http://pinterest.com/pin/create/bookmarklet/?media=video&url=$page_url&is_video=false&description=$title";

        $link = "<a href = '$url' target='_blank' class='button large pinterest'><i class='fa fa-pinterest-p fa-2x'></i></a>";

        return $link;
    }

    public function reddit($page_url, $title = null)
    {
        $url = "http://www.reddit.com/submit?url=$page_url&title=$title";

        $link = "<a href = '$url' target='_blank' class='button large reddit'><i class='fa fa-reddit-alien fa-2x'></i></a>";

        return $link;
    }

}