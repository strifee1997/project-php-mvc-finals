<?php
// Single Responsibility Principle
declare(strict_types=1);

namespace Core\Http;

class Response
{
    public function __construct(
        private string $content = '',
        private int $statusCode = 200,
        private array $headers = []
    ) {}

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public static function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }


    public function json(array $data, int $statusCode = 200): self
    {
        $this->setContent(json_encode($data));
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'application/json');
        
        return $this;
    }

    public function send(): void //go!
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->content;
    }
}
