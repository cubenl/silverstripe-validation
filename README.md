# SilverStripe Validation

[![Build Status](https://travis-ci.org/cubenl/silverstripe-validation.svg?branch=master)](https://travis-ci.org/cubenl/silverstripe-validation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cubenl/silverstripe-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cubenl/silverstripe-validation/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/cubenl/silverstripe-validation/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cubenl/silverstripe-validation/build-status/master)
[![codecov.io](https://codecov.io/github/cubenl/silverstripe-validation/coverage.svg?branch=master)](https://codecov.io/github/cubenl/silverstripe-validation?branch=master)

[![GitHub Code Size](https://img.shields.io/github/languages/code-size/cubenl/silverstripe-validation)](https://github.com/cubenl/silverstripe-validation)
[![GitHub Last Commit](https://img.shields.io/github/last-commit/cubenl/silverstripe-validation)](https://github.com/cubenl/silverstripe-validation)
[![GitHub Issues](https://img.shields.io/github/issues/cubenl/silverstripe-validation)](https://github.com/cubenl/silverstripe-validation/issues)

SilverStripe module for out of the box validating DataObjects and more! <br>
Inspired by the `Illuminate\Validation` Laravel way of defining validation rules.

## Requirements

- SilverStripe Framework 4.0+

## Quick Start

### Installation

```
composer require cubenl/silverstripe-validation
```

## Documentation

- [Validating DataObjects](./docs/en/dataobjects.md)
- [Available Validation Rules](./docs/en/available-validation-rules)
- [Custom Validation Rules](./docs/en/custom-validation-rules)
- [Custom Error Messages](./docs/en/custom-error-messages.md)
- [Translations](./docs/en/translations.md)

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

## Reporting Issues

Please [create an issue](http://github.com/cube-nl/silverstripe-validation/issues) for any bugs you've found, or features you're missing.

## Contributing

Please see [contributing](./CONTRIBUTING.md) for some guidelines to contribute.
