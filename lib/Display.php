<?php

namespace lib;
class Display
{
    private string $title = 'Chat Avenue';
    private string $description = '';
    private string $theme = 'default';
    private string $color = '#000000';

    public function __construct(string $page, string $pageName = "", string $additive = '')
    {
        // If you're in a room or important page, adjust the title
        if (isset($pageName)) {
            $this->title = "$pageName on $this->title";
        }

        $head = $this->buildHead();
        $body = $this->buildBody($page);

        echo $this->minify("
            <!doctype html>
            <html lang='en'>
            $head
            $body
            </html>
        ");
    }

    private function buildHead(): string
    {
        $title = $this->title;
        $description = $this->description;
        $color = $this->color;
        $host_url = $_SERVER['HTTP_HOST'];

        // Output as much HTML Metadata as possible
        return "
            <head>
            <title>$title</title>
            <meta name='title' content='$title' />
            <meta name='description' content='$description' />
            <meta charset='utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1' />
            <meta name='theme-color' content='$color'>
            <meta property='og:type' content='website' />
            <meta property='og:url' content='https://$host_url' />
            <meta property='og:title' content='$title' />
            <meta property='og:description' content='$description' />
            <meta property='og:image' content='https://$host_url/static/banner.svg' />
            <meta property='twitter:card' content='summary_large_image' />
            <meta property='twitter:url' content='https://$host_url' />
            <meta property='twitter:title' content='$title' />
            <meta property='twitter:description' content='$description' />
            <meta property='twitter:image' content='https://$host_url/static/banner.svg' />
            <link rel='canonical' href='https://$host_url' />
            <link rel='license' href='https://$host_url/policies' />        
            <link rel='icon' href='/static/favicon.svg' type='text/xml' />
            <link rel='mask-icon' href='/static/mono-favicon.svg' color'$color'>
            <link rel='apple-touch-icon' href='/static/favicon.svg'>
            </head>
        ";
    }

    private function buildBody(string $page): string
    {
        $pageContent = Includes::import_template($page, []);
        return "
        <body>
        $pageContent
        </body>
        ";
    }

    private function minify(string $html): string
    {
        $search = array(
            // Whitespace before/after tags
            '/>[^\S ]+/',
            '/[^\S ]+</',
            // Removes multiple-whitespaces
            '/(\s)+/',
            // Removes comments
            '/<!--(.|\s)*?-->/',
            // Remove newlines
            '/\n/'
        );
        $replace = array('>', '<', '\\1');
        return preg_replace($search, $replace, $html);
    }
}
