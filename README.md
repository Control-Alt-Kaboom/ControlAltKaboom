# ControlAltKaboom

A simple web site/application kick-starter. Its basically a simple/stripped-down framework that contains many of the commonly required components for both production and development environments. This package is primarily a private codebase and is not written or designed with any intent to support the public, however its freely available for anyone who feels they can use it. 


> With that said, there should be an understanding of liability and support - There is none.


## Installation Requirements

> This package relies on [composer](https://getcomposer.org/) for installation. Aside from just being an easy way to get things going, it resolves many dependancies and creates the autoloading feature that the package as a whole requires.

For a complete installation and configuration how-to, see [InstallAndConfigure.md](docs/InstallAndConfigure.md)


## Whats Included

The following table represents the included components, their development state, and links to their respected packages and documentation


| Component | Description | Version | Source | Tests | Docs |
| --------- | ----------- |:-------:|:------:|:-----:|:----:|
| AppBase\Common | A set of helper functions for common tasks | 0.1.dev | [src](src/AppBase/Common) | [tests](tests/AppBase/Common) | [docs](docs/AppBase_Common.md) |
| AppBase\Control | A set of methods used for simple api/tpl parsing | 0.1.dev | [src](src/AppBase/Control) | [tests](tests/AppBase/Control) | [docs](docs/AppBase_Control.md) |
| AppBase\Debug | A set of methods used for debugging | 0.5.prod| [src](src/AppBase/Debug.php) | [tests](tests/AppBase/DebugTest.php) | [docs](docs/AppBase_Debug.md) |
| AppBase\Inflector| A set of methods used for inflection | 1.0.prod | [src](src/AppBase/Inflector.php) | [tests](tests/AppBase/InflectorTest.php) | [docs](docs/AppBase_Inflector.md) |
| Database | MySQL Database Abstraction and Data-Model Base-Classes |0.1.dev | [src](src/Database) | [tests](tests/Database) | [docs](docs/Database.md) |
| EventRegistry| Event Registration and Dispatching Handlers | 0.1.dev | [src](src/EventRegistry) | [tests](tests/EventRegistry) | [docs](docs/EventRegistry.md) |
| Exceptions | Exception Handlers and Templates  | 0.5.dev | [src](src/Exception) | [tests](tests/Exception) | [docs](docs/Exceptions.md) |
| ModelViewController | A simple stripped down MVC Framework | 0.1.dev | [src](src/ModelViewController) | [tests](tests/ModelViewController) | [docs](docs/ModelViewController.md) |
| Sessions | A simple DB-Session management class | 0.1.dev | [src](src/Sessions) | [tests](tests/Sessions) | [docs](docs/Sessions.md) |
| Sockets | Allows for listenting and dispatching to web sockets | 0.1.dev | [src](src/Sockets) | [tests](tests/Sockets) | [docs](docs/Sockets.md) |
| scripts\backup| Bash-Based file and database backup script. | 1.0.prod | [src](scripts/backup) |  | [docs](scripts/backup/README.md) |



