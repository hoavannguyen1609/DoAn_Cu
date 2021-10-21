<?php
abstract class ServiceProvider {
    public $all = null;
    abstract function boot();
}