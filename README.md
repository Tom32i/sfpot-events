[DRAFT] Symfony2: working with events
=============================

## Symfony2 EventDispatcher Component

* Event: Symfony\Component\EventDispatcher\Event (name, propagation)
* Dispatcher: Event are dispatched
* Listener: Event are received

## What we don't want to do

* Coupling domain workflow/logic with controllers and doctrine events

## Create custom event for changes that are relevant for domain

* Creating Custom Event

## Dispatching events

* Doctrine (Post flush trick)
* Domain services

## Listening to events

* Domain services (Mailer, Export, ...)
* Working with kernel.terminate
