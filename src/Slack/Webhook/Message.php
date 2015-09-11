<?php

namespace IgnisLabs\SlackEmoji\Slack\Webhook;

class Message implements \JsonSerializable
{
    private $message;

    private $channel;

    private $username;

    private $iconType;

    private $icon;

    public function __construct($message, $channel = null, $username = null, $icon = null)
    {
        $this->message = $message;
        $this->setChannel($channel);
        $this->username = $username;
        $this->setIcon($icon);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message the message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel the channel
     */
    public function setChannel($channel)
    {
        if (!is_null($channel)) {
            if (!preg_match('/^[@#]/i', $channel)) {
                throw new \DomainException("Invalid channel [$channel]");
            }

            $this->channel = $channel;
        }
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username the username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getIconType()
    {
        return $this->iconType;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set message icon
     *
     * If it's formatted as :text: it sets as emoji
     * If it starts with http(s):// it sets as url
     *
     * @param string $icon the icon
     */
    public function setIcon($icon)
    {
        if (!is_null($icon)) {
            if (preg_match('/^:.+:$/i', $icon)) {
                $this->iconType = 'emoji';
            } elseif (preg_match('/^https?:\/\//i', $icon)) {
                $this->iconType = 'url';
            } else {
                throw new \DomainException("Invalid icon [$icon]");
            }

            $this->icon = $icon;
        }
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        $payload = [
            'text' => $this->getMessage(),
        ];

        if ($this->getChannel()) {
            $payload['channel'] = $this->getChannel();
        }

        if ($this->getUsername()) {
            $payload['username'] = $this->getUsername();
        }

        if ($this->getIcon()) {
            $payload['icon_' . $this->iconType] = $this->getIcon();
        }

        return $payload;
    }
}
