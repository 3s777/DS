<?php

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'helper_flash_message';
    public const MESSAGE_TYPE_KEY = 'helper_flash_type';
    public const MESSAGE_ICON_KEY = 'helper_flash_icon';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if(!$message) {
            return null;
        }

        return new FlashMessage(
            $message,
            $this->session->get(self::MESSAGE_TYPE_KEY, ''),
            $this->session->get(self::MESSAGE_ICON_KEY, false)
        );
    }

    public function info(string $message, string $icon = ''): void
    {
        $this->setFlashData($message, 'info', $icon);
    }

    public function success(string $message, string $icon = ''): void
    {
        $this->setFlashData($message, 'success', $icon);
    }

    public function warning(string $message, string $icon = ''): void
    {
        $this->setFlashData($message, 'warning', $icon);
    }

    public function danger(string $message, string $icon = ''): void
    {
        $this->setFlashData($message, 'danger', $icon);
    }

    private function setFlashData(string $message, string $type, string $icon): void
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_TYPE_KEY, config("flash.$type"));
        if($icon) {
            $this->session->flash(self::MESSAGE_ICON_KEY, 'svg.'.$icon);
        }
    }
}
