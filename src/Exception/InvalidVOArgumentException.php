<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\Exception;

use Throwable;

class InvalidVOArgumentException extends \InvalidArgumentException implements ExceptionVO
{
    /** @var mixed */
    private $object;

    /**
     * InvalidVOArgumentException constructor.
     * @param string $message
     * @param mixed $object
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', $object = null, int $code = 0, Throwable $previous = null)
    {
        if (!$message) {
            throw new $this('Unknown '. \get_class($this));
        }
        $this->object = $object;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->object !== null) {
            ob_start();
            echo '<pre>';
            var_dump($this->object);
            echo '</pre>';
            $this->message = $this->message . "\nDebug Info: " . ob_get_clean();
        }
        return get_class($this) . " '{$this->message}'\n in {$this->file}({$this->line})\n{$this->getTraceAsString()}";
    }
}
