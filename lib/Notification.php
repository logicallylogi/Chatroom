<?php

namespace lib;
class Notification
{
    public function __construct(string $from, string $content)
    {
        $this->build($from, $content, "info");
    }

    private function build(string $from, string $content, string $color = "primary"): void
    {
        $since = round(microtime(true) * 1000);
        echo "
            <div class='toast fade show' role='alert' aria-live='assertive' aria-atomic='true' data-since='$since'>
                <div class='toast-header'>
                    <strong class='me-auto'>$from</strong>
                    <small class='text-body-secondary'>now</small>
                    <button type='button' class='btn-close btn-close-white' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
                <div class='toast-body'>$content</div>
            </div>";
    }
}
