# Laradmin
A simple, powerful, drop-in administrative interface for Laravel.

This project came about from a desire to have a simple administrative interface that could be dropped into a new or existing Laravel based site to manage any/all editable content.

## Objectives & Goals

- Works with standard Laravel user authentication.
- Drops in as a simple dependency via composer.
- Fully overriddable by custom scripting in order to extend as needed.
- Clean & simple interface.
- Extensible to support any type of content data.
- Support common model relationships.
- Community driven.

## Architecture Ideas

- Entirely controlled through a config file.
- Config file defines list of models to support admin CRUD.
- Model config describes: 
  - validation rules
  - text labels (plural, singular, ...)
  - controller classname (if overridden)
  - route name
  - path
  - displayed index fields (for use in the view)
- Config file defines each field on each model as to the following:
  - Label
  - Name
  - Type (input, textarea, checkbox, radio, select, image upload, relationship, tags list, ...)
  - Placeholder
  - Default value
  - Relationship details (if any)
- Field types are tied directly to view partials.
