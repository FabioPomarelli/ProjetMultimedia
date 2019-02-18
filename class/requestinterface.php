<?php
interface RequestInterface {
  public function getParam(string $key): string;
  public function getParams(): array;
  public function route(): string;
}
