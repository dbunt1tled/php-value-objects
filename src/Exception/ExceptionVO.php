<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\Exception;

interface ExceptionVO
{
    public function getMessage();
    public function getCode();
    public function getFile();
    public function getLine();
    public function getTrace();
    public function getTraceAsString();
    public function __toString();
}
