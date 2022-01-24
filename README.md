# EE Objects Controller

This library provides a different approach to how ExpressionEngine Control Panel objects are structured and managed. Instead of a single object with multiple route methods, as is currently in place, this flips the paradigm to allow for a compartmentalized approach of Route objects, instead. 

> In a nutshell, instead of Module methods for template tags, actions, and Control Panel routes, you create objects instead. 

### The Problems This Solve

EE Objects Controller was created in direct response to the many KLOC Control Panel objects within ExpressionEngine being a reality. Any moderately complicated or involved solution that requires a Control Panel layer was doomed to endless scrolling and a disturbing lack of state within their programs. Now, compartmentalization is on the table once again. 

## Requirements
- ExpressionEngine >= 5.5
- PHP >= 7.1
 
## Installation

Add `ee-objects/controllers` as a requirement to your `composer.json`:

```bash
$ composer require ee-objects/controllers
```

### Implementation

To use this library within your ExpressionEngine website, you'll have to make a couple changes to your code. For a complete implementation example, be sure to take a look at the [EeObjects Addon](https://github.com/EE-Objects/Example-Addon) repository.

## Docs

Available in the [Wiki](https://github.com/EE-Objects/Controllers/wiki "Wiki") and the [EeObjects Addon](https://github.com/EE-Objects/Example-Addon) repository
